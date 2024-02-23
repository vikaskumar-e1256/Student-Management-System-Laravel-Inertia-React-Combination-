import React from 'react';

const SuccessMessage = ({ message, onClose }) => {
    return (
        <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong className="font-bold">Success!</strong>
            <span className="block sm:inline"> {message}</span>
            <span className="absolute top-0 bottom-0 right-0 px-4 py-3" onClick={onClose}>
                <svg
                    className="fill-current h-6 w-6 text-green-500"
                    role="button"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <title>Close</title>
                    <path
                        fillRule="evenodd"
                        d="M14.348 5.652a.5.5 0 0 1 0 .707L10.06 10l4.288 4.288a.5.5 0 1 1-.708.708L9.352 10l-4.29 4.29a.5.5 0 1 1-.708-.708L8.646 10 4.357 5.712a.5.5 0 0 1 .708-.708L10 9.352l4.288-4.288a.5.5 0 0 1 .708 0z"
                    />
                </svg>
            </span>
        </div>
    );
};

export default SuccessMessage;
