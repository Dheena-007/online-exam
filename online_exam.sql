-- Create the database
CREATE DATABASE online_exam;
USE online_exam;

-- Create the 'users' table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert sample users
INSERT INTO users (username, password) VALUES 
('dheena', '638072'), 
('kishore', '936091');

-- Create the 'questions' table
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    option1 VARCHAR(255) NOT NULL,
    option2 VARCHAR(255) NOT NULL,
    option3 VARCHAR(255) NOT NULL,
    option4 VARCHAR(255) NOT NULL,
    answer VARCHAR(255) NOT NULL
);

-- Insert sample questions
INSERT INTO questions (question, option1, option2, option3, option4, answer) VALUES
('What is the capital of France?', 'Berlin', 'Madrid', 'Paris', 'Rome', 'option3'),
('What is 2 + 2?', '3', '4', '5', '6', 'option2'),
('Which planet is known as the Red Planet?', 'Earth', 'Mars', 'Jupiter', 'Saturn', 'option2'),
('Who wrote "To Kill a Mockingbird"?', 'Harper Lee', 'Mark Twain', 'Ernest Hemingway', 'F. Scott Fitzgerald', 'option1'),
('What is the largest ocean on Earth?', 'Atlantic Ocean', 'Indian Ocean', 'Arctic Ocean', 'Pacific Ocean', 'option4');
