CREATE TABLE exams (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    created_date DATE NOT NULL,
    scheduled_date DATE NOT NULL,
    pass_mark VARCHAR(255) NOT NULL,
    status VARCHAR(255) NOT NULL
);

CREATE TABLE questions (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    weight INT NOT NULL,
    examid INT NOT NULL
);

CREATE TABLE options (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    iscorrect TINYINT NOT NULL,
    questionid INT NOT NULL
);

CREATE TABLE userexam (
    userid INT NOT NULL,
    examid INT NOT NULL
);

CREATE TABLE results (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userid INT NOT NULL,
    examid INT NOT NULL,
    score INT NOT NULL,
    status TINYINT NOT NULL
);

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    role varchar(255) NOT NULL
);

INSERT INTO `users`(`name`, `email`, `password`, `role`) VALUES (
    'Administrator', 
    'admin@admin.com', 
    '$2y$10$ADarFGeU1lY99wXvZe5uPOn1T6jaXP1LyK/yGlhK6fRhlhMcNevNm',
    'admin'
);
