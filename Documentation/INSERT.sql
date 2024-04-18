INSERT INTO genres (name) VALUES 
('Science Fiction'),
('Fantasy'),
('Mystery'),
('Thriller');

INSERT INTO authors (name) VALUES 
('J.K. Rowling'),
('Stephen King'),
('Agatha Christie'),
('George Orwell');

INSERT INTO user_role (name) VALUES 
('User'),
('Admin');

INSERT INTO books (title, publication_date, created_at, updated_at) VALUES 
('Harry Potter and the Philosopher\'s Stone', '1997-06-26', NOW(), NOW()),
('The Shining', '1977-01-28', NOW(), NOW()),
('Murder on the Orient Express', '1934-01-01', NOW(), NOW()),
('1984', '1949-06-08', NOW(), NOW());
