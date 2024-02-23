import { useState, useEffect } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { useForm } from '@inertiajs/react';
import SuccessMessage from '@/Components/SuccessMessage';


export default function Dashboard({ auth, classes, create_url }) {
    const { data, setData, post, errors } = useForm({
        classes_id: '',
        subject_ids: [],
    });

    const [successMessage, setSuccessMessage] = useState('');
    const [availableSubjects, setAvailableSubjects] = useState([]);

    useEffect(() => {
        if (data.classes_id) {
            fetchSubjectsBasedOnClass(data.classes_id);
        }
    }, [data.classes_id]);

    const fetchSubjectsBasedOnClass = async (selectedClassId) => {
        try {
            const response = await fetch(`/api/subjects?class=${selectedClassId}`);
            if (response.ok) {
                const subjects = await response.json();
                setAvailableSubjects(subjects);
            } else {
                console.error('Failed to fetch subjects');
            }
        } catch (error) {
            console.error('Error fetching subjects:', error);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post(create_url, {
            onSuccess: () => {
                setSuccessMessage('Information updated successfully!');
                setData({
                    classes_id: '',
                    subject_ids: [],
                });
            },
        });
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <h2 className="text-lg font-semibold mb-4">Assigned Class & Subject to Teacher</h2>

                            {successMessage && (
                                <SuccessMessage message={successMessage} onClose={() => setSuccessMessage('')} />
                            )}

                            <form onSubmit={handleSubmit}>

                                <div className="mb-4">
                                    <label htmlFor="class" className="block text-sm font-medium text-gray-700">
                                        Class
                                    </label>
                                    <select
                                        id="class"
                                        className="mt-1 p-2 border border-gray-300 rounded-md w-full"
                                        value={data.classes_id}
                                        onChange={(e) => setData('classes_id', e.target.value)}
                                    >
                                        <option value="">Select Class</option>
                                        {classes.map((classItem) => (
                                            <option key={classItem.id} value={classItem.id}>
                                                {classItem.name}
                                            </option>
                                        ))}
                                    </select>
                                    {errors.classes_id && <p className="text-red-500 text-sm mt-1">{errors.classes_id}</p>}
                                </div>

                                <div className="mb-4">
                                    <label htmlFor="subjects" className="block text-sm font-medium text-gray-700">
                                        Subjects
                                    </label>
                                    <select
                                        id="subjects"
                                        className="mt-1 p-2 border border-gray-300 rounded-md w-full"
                                        value={data.subject_ids}
                                        onChange={(e) => setData('subject_ids', Array.from(e.target.selectedOptions, option => option.value))}
                                        multiple
                                    >
                                        {availableSubjects.map(subject => (
                                            <option key={subject.id} value={subject.id}>{subject.name}</option>
                                        ))}
                                    </select>
                                    {errors.subject_ids && <p className="text-red-500 text-sm mt-1">{errors.subject_ids}</p>}
                                </div>

                                <div>
                                    <button
                                        type="submit"
                                        className="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                                    >
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
