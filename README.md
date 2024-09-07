# Vehicle order
it's a web app that handle vehicle ordering with 2 level or more approvals, managing vehicle and more. Build using Filament and Laravel.
![image](https://github.com/user-attachments/assets/ee21f7ae-c01f-46db-b56d-01501e94e11a)

## Physical data model
![physical-data](https://github.com/user-attachments/assets/3d2f7fb8-2ee2-4772-ae5a-b06f81b78914)

## Activity Diagram for Approval feature
![Pasted image](https://github.com/user-attachments/assets/1844438b-ce93-4441-8f99-f020c982e620)

## Installation
### Environment info
This app developed with
- Php: 8.3.11
- Laravel: 11.22.0
- Composer: 2.7.9
- MariaDB/MySQL : 11.5.2
---
![image](https://github.com/user-attachments/assets/059b0fd5-ac49-4724-a7f5-33cb56c2f93e)
![image](https://github.com/user-attachments/assets/3982c6da-38b4-4cb2-8131-908b1631295b)

### Prequisite
1. PHP installed
2. Composer Installed
3. MySQL service ready
### Install Step
1. clone this repo
    ```sh
        git clone https://github.com/FShou/vehicle-order
    ```
2. install requreid deps with `composer`
    ```sh
    composer install
    ```
3. rename .env.example to .env and configure Database env like following
    ```sh
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=vehicles_orders
    DB_USERNAME=YOUR_DB_USERNAME
    DB_PASSWORD=YOUR_DB_PASSWORD
    ```
4. generate laravel key
    ```sh
    php artisan key:generate
    ```
5. run the migration and seeder
    ```sh
    php artisan migrate:freesh --seed
    ```
6. run the app
    ```sh
    php artisan serve
    ```
## Usage
There are 3 default user
- Admin 
     ```
     email:
     admin@mail.com

     password:
     123
     ```
- Supervisor as ( Approver 1 )
    ```
     email:
     supervisor@mail.com

     password:
     123

     ```
- Ketua Peminjaman as (Approver 2)
   ```
     email:
     ketua@mail.com

     password:
     123
     ```

   ### How to use
  
  1. Go to localhost:8000 (depend on laravel output )
  2. Log in with Admin account first
  3. Go to Order and create new on the Order
  4. Log Out
  5. Login as supervisor to approve
  6. Login as ketua to final approvement
  7. You can also Export the Orders table to XLX,XLS,or CSV





## Contributing
Contributions are welcome! Please open an issue or submit a pull request for any improvements or bug fixes.

## Acknowledgements
- [fogleman/ease](https://github.com/fogleman/ease) - Easing functions library used in this project.
- [Hyprland](https://hyprland.org) 
