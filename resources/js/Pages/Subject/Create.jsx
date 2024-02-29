import { useState, useRef } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { useForm } from '@inertiajs/react';
import SuccessMessage from '@/Components/SuccessMessage';
import Multiselect from 'multiselect-react-dropdown';


export default function Dashboard({ auth, languages, classes }) {

    const { data, setData, post, errors } = useForm({
        name: '',
        languages: [],
        classes_id: [],
    });

    const [successMessage, setSuccessMessage] = useState('');
    const languageMultiselectRef = useRef(null); // Ref for languages Multiselect
    const classMultiselectRef = useRef(null); // Ref for classes Multiselect


    const [selectedLanguages, setSelectedLanguages] = useState([]);
    const [selectedClasses, setSelectedClasses] = useState([]);

    const handleLanguageSelect = (selectedList, selectedItem) => {
        const selectedLanguageIds = selectedList.map(language => language.id);
        setData('languages', selectedLanguageIds);
        setSelectedLanguages(selectedList);
    }

    const handleLanguageRemove = (selectedList, removedItem) => {
        const selectedLanguageIds = selectedList.map(language => language.id);
        setData('languages', selectedLanguageIds);
        setSelectedLanguages(selectedList);
    }

    const handleClassSelect = (selectedList, selectedItem) => {
        const selectedClassesIds = selectedList.map(classes => classes.id);
        setData('classes_id', selectedClassesIds);
        setSelectedClasses(selectedList);
    }

    const handleClassRemove = (selectedList, removedItem) => {
        const selectedClassesIds = selectedList.map(classes => classes.id);
        setData('classes_id', selectedClassesIds);
        setSelectedClasses(selectedList);
    }

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('subject.store'), {
            onSuccess: () => {
                setSuccessMessage('Subject added successfully!');
                setData({
                    name: '',
                    languages: [],
                    classes_id: [],
                });
                if (languageMultiselectRef.current) {
                    languageMultiselectRef.current.resetSelectedValues();
                }
                if (classMultiselectRef.current) {
                    classMultiselectRef.current.resetSelectedValues();
                }

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
                            <h2 className="text-lg font-semibold mb-4">Add a Subject</h2>

                            {successMessage && (
                                <SuccessMessage message={successMessage} onClose={() => setSuccessMessage('')} />
                            )}

                            <form onSubmit={handleSubmit}>
                                <div className="mb-4">
                                    <Multiselect
                                        options={languages}
                                        selectedValues={selectedLanguages}
                                        onSelect={handleLanguageSelect}
                                        onRemove={handleLanguageRemove}
                                        displayValue="name"
                                        placeholder="Choose Languages"
                                        ref={languageMultiselectRef}
                                    />
                                    {errors.languages && <p className="text-red-500 text-sm mt-1">{errors.languages}</p>}
                                </div>
                                <div className="mb-4">
                                    <Multiselect
                                        options={classes}
                                        selectedValues={selectedClasses}
                                        onSelect={handleClassSelect}
                                        onRemove={handleClassRemove}
                                        displayValue="name"
                                        placeholder="Choose Class"
                                        ref={classMultiselectRef}
                                    />
                                    {errors.classes_id && <p className="text-red-500 text-sm mt-1">{errors.classes_id}</p>}
                                </div>
                                <div className="mb-4">
                                    <label htmlFor="name" className="block text-sm font-medium text-gray-700">
                                        Name
                                    </label>
                                    <input
                                        type="text"
                                        id="name"
                                        className="mt-1 p-2 border border-gray-300 rounded-md w-full"
                                        value={data.name}
                                        onChange={(e) => setData('name', e.target.value)}
                                    />
                                    {errors.name && <p className="text-red-500 text-sm mt-1">{errors.name}</p>}
                                </div>
                                <div>
                                    <button
                                        type="submit"
                                        className="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                                    >
                                        Add Subject
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
