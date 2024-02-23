import { useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function SubjectList({ auth, subjects }) {
    const [searchTerm, setSearchTerm] = useState('');

    const filteredSubjects = subjects.filter((subject) =>
        subject.name.toLowerCase().includes(searchTerm.toLowerCase())
    );

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Subject List" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <h2 className="text-2xl font-semibold mb-6">Subject List</h2>

                            <div className="flex items-center mb-6">
                                <input
                                    type="text"
                                    placeholder="Search by name"
                                    value={searchTerm}
                                    onChange={(e) => setSearchTerm(e.target.value)}
                                    className="p-2 border border-gray-300 rounded-l-md focus:outline-none focus:border-blue-500"
                                />
                                <button
                                    onClick={() => setSearchTerm('')}
                                    className="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 focus:outline-none"
                                >
                                    Clear
                                </button>
                            </div>

                            <div className="overflow-x-auto">
                                <table className="table-auto w-full">
                                    <thead>
                                        <tr className="bg-gray-200">
                                            <th className="px-4 py-2">Subject Name</th>
                                            <th className="px-4 py-2">Available Languages</th>
                                            <th className="px-4 py-2">Assigned Teacher</th>
                                            <th className="px-4 py-2">Students</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {filteredSubjects.map((subject, index) => (
                                            <tr key={subject.id} className={index % 2 === 0 ? 'bg-white' : 'bg-gray-100'}>
                                                <td className="px-4 py-2 text-center">{subject.name}</td>
                                                <td className="px-4 py-2 text-center">
                                                    <div className="flex items-center justify-center">
                                                        <textarea
                                                            className="p-2 border border-gray-300 rounded-md h-24 w-48 resize-none"
                                                            readOnly
                                                            value={subject.languages.map((language) => `• ${language.name}`).join('\n')}
                                                        ></textarea>
                                                    </div>
                                                </td>
                                                <td className="px-4 py-2 text-center">
                                                    <div className="flex items-center justify-center">
                                                        <textarea
                                                            className="p-2 border border-gray-300 rounded-md h-24 w-48 resize-none"
                                                            readOnly
                                                            value={subject.teachers.map((teacher) => `• ${teacher.name}`).join('\n')}
                                                        ></textarea>
                                                    </div>
                                                </td>
                                                <td className="px-4 py-2 text-center">
                                                    <div className="flex items-center justify-center">
                                                        <textarea
                                                            className="p-2 border border-gray-300 rounded-md h-24 w-48 resize-none"
                                                            readOnly
                                                            value={subject.students.map((student) => `• ${student.name}`).join('\n')}
                                                        ></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
