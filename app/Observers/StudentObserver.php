<?php

namespace App\Observers;

use App\Models\Student;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }

    public function creating(Student $student)
    {
        $student->roll_number = $this->generateUniqueRollNumber();
    }

    private function generateUniqueRollNumber()
    {
        $rollNumber = 'RN' . mt_rand(100000, 999999);

        // Check if the roll number is already used
        while (Student::where('roll_number', $rollNumber)->exists()) {
            $rollNumber = 'RN' . mt_rand(100000, 999999); // Regenerate a roll number
        }

        return $rollNumber;
    }
}
