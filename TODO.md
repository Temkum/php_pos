# POS System with PHP

Point of Sale that allows several managers to administrate all system characteristics like inventory, sales, billing, invoicing, clients, admins and reports etc.

- Built with PHP8, OOP and MVC architecture.
- MySQL for database management.

* Create a CRUD inventory manager who can check stock quantity, edit, delete or add new products.
* They will also be able to add clients into the system, payment methods
* Sales reports and option to export to Excel
* Print invoice and reports

- System will also indicate best customers and top selling products
- User roles applied.
- Responsive design for all screen devices.

### Sublime text plugins

Emmet - `command`
advanceNewFie - `ctrl + alt + n`
alignment - `ctla + alt + a`
autoFileName - inside attribute
Bracket highlighter - comment snippets - comm section tab
console wrap - `ctrl + shift + q`
html minifier - `ctrl + shift m`
js format - `ctrl + alt + f``
php syntax checker - window alert whem error

- Install local server
- Install code editor
- Get template

## Plugins and extension using jquery and js

- Bootstrap
- Fontawesome
- Ionicons
- Theme style adminLite
- Morris chart (css and js)
- Skins adminlite
- Jvsctormap (css and js)
- Date range picker
- data tables
- iCheck
- jQuery knob
- Chart js
- input mask
- sweet alert
- jQuery number
- Adminlite app

## MVC adminlite template

## Add modules for pos system

## 404 page

## Login page

- login session
- logout session

## Build user model

## Add user to db

## encrypt password

## set session variable

## display users to dashboard

## Update user info

- create an update method
- load data from db

> Fix user login and user update feature

## activate and deactivate users

## add last login

## delete users

# Categories module

- create category template
- add category template
- create controller and model
- add category methods in controller and model

### display or read categories from database

### edit category

- create an edit method in model and controller
- delete categories

## PRoduct section

- used to manage inventory
- build the view layout

> fix loading products using dynamic datatable plugin
> Error: DataTables warning: table id=DataTables_Table_0 - Cannot reinitialise DataTable. For more information about this error, please see http://datatables.net/tn/3

> **Fix** By adding `.destroy()` to your function like so

```
$('#example').dataTable({

    destroy: true,
    ...

}).destroy();
```
