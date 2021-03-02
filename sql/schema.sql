-- Database: `import_csv`
-- --------------------------------------------------------

-- Table structure for table `students`
CREATE DATABASE IF NOT EXISTS import_csv;

-- Table structure for table `students`
CREATE TABLE students (
  `id` int(11) NOT NULL,
  `studentNumber` int(5) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `courseCode` char(5) NOT NULL,
  `courseDescription` varchar(55) NOT NULL,
  `grade` char(1) NOT NULL
);

-- Indexes for table `students`
ALTER TABLE students
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT for table `students`
ALTER TABLE students
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;