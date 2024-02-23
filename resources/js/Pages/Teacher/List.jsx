import { useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function StudentList({ auth, teachers }) {
    const [searchTerm, setSearchTerm] = useState('');

    const filteredTeachers = teachers.filter((teacher) =>
        teacher.name.toLowerCase().includes(searchTerm.toLowerCase())
    );

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Teacher List" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <h2 className="text-2xl font-semibold mb-6">Teacher List</h2>

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
                                            <th className="px-4 py-2">Name</th>
                                            <th className="px-4 py-2">Age</th>
                                            <th className="px-4 py-2">Sex</th>
                                            <th className="px-4 py-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {filteredTeachers.map((teacher, index) => (
                                            <tr key={teacher.id} className={index % 2 === 0 ? 'bg-white' : 'bg-gray-100'}>
                                                <td className="px-4 py-2 text-center">{teacher.name}</td>
                                                <td className="px-4 py-2 text-center">{teacher.age}</td>
                                                <td className="px-4 py-2 text-center">{teacher.sex}</td>
                                                <td className="px-4 py-2 text-center">
                                                    <Link href={route('teacher.assigned.classAndSubject', teacher.id)}
                                                        className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none"
                                                    >
                                                        Assign Class and Subjects
                                                    </Link>
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
