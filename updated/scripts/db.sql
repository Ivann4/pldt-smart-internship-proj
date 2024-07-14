USE pldttest;

DROP TABLE IF EXISTS Tasks;
DROP TABLE IF EXISTS UserInformation;
DROP TABLE IF EXISTS Users;

CREATE TABLE Users(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(75) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM("employee","admin")
);

CREATE TABLE UserInformation(
    userInfo_id INT PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    phone_number VARCHAR(255) NOT NULL,
    position ENUM(
        "IT PROJECT MANAGER", "IT DATA ANALYST", "PROJECT COORDINATOR", 
        "NETWORK ENGINEER", "INFRASTRUCTURE MANAGER", "OPERATION ANALYST",
        "INFORMATION SECURITY CONSULTING", "COMPLIANCE OFFICER", "INCIDENT RESPONDER"),
    team_name VARCHAR(255),
    Department ENUM("IT", "TRANSPORT", "CYBERSECURITY"),
    administrator INT,
    administrator_name VARCHAR(255), -- denormalized to prevent join or multiple queries
    FOREIGN KEY (userInfo_id) REFERENCES Users(user_id),
    FOREIGN KEY (administrator) REFERENCES Users(user_id)
);

CREATE TABLE Tasks(
    task_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    task_name VARCHAR(255),
    deadline TIMESTAMP,
    priority ENUM("LOW", "MODERATE", "HIGH"),
    status ENUM("NOT STARTED", "IN-PROGRESS", "COMPLETE"),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
