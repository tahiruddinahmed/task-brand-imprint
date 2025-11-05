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

  
