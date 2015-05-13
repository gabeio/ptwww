Programming the WWW
===================
(Kean University)

## Objectives
- Third Normal Form Database ((my)SQL)
- Books
- Multiple Authors
- Multiple Orders
- Cart

## Tables
**author**
- author_id (int pk ai)
- firstName (varchar)
- lastName (varchar)

**book**
- book_id (int pk ai)
- description (text)
- price (decimal 60,2)
- title (varchar)
- publisher_id (int)

**cart**
- book_id (int)
- user_id (int)

**item**
- author_id (int)
- book_id (int)

**order**
- order_id (int pk ai)
- timestamp (timestamp)
- total (decimal 60,2)
- user_id (int)

**orderDetails**
- book_id (int)
- order_id (int)

**publisher**
- publisher_id (int pk ai)
- name (varchar)

**user**
- user_id (int pk ai)
- email (varchar)
- firstName (varchar)
- lastName (varchar)
- hash (varchar/text) (depends on hash alg) (for password)
- phone (varchar 10-20)
- username (varchar)