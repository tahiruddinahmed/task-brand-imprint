# Task: 
**Tahir Uddin Ahmed**

## Task Description: 
Complete CRUD Operation
Complete it by:- 06-11-2025

### User Master
```
User_master(Table name)//for login
id,
Name,
phone(username),
password,
role(Admin,Employee),
````


### Customer_master
```
customer_master(Table name)
id,
name,(required)
phone,(required)
email,
address,
created_by,
is_deleted
```

### Product_master (Aceess: `Admin`)
```
//admin access(crud)
product_master(Table name)
id,
name,
remarks
```

### Purchase Master (Access: Both `admin` and `customer`)
```
//will create by employees
purchase_master(Table name)
id,
customer_id,
product_id,
invoice_no,
prchase_date,
value,
```

1.Admin has access of all of these.

2.Employees can see only its login, can create customers, can create purchases.
  - employees can see their created customers purchases.

## Installation

### Steps 
1. Clone the repository 
```bash
git clone https://github.com/tahiruddinahmed/task-brand-imprint.git
```

2. Install PHP Dependencies: 
```bash
php composer install 
```

3. Setup Environment: 
Go to the project directory `copy` the `.env.example`, create a new file called `.env` and past all the codes.

```bash 
cp .env.example .env
```
Open the `.env` file and configure your database connection and other settings

4. Run PHP Migration and Seed the Database. 
```bash
php artisan migrate --seed
```

5. Start the project 
```bash 
php artisan serve
```
