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
- Php extentions :
    - ![image](https://github.com/user-attachments/assets/66033073-9ca5-463e-ba7c-926d96989d20)
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
5. run the migration with seeder
    ```sh
        php artisan migrate --seed
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
1. Go to localhost:8000 (depend on laravel output ) and it will be redirected to `/login` Log in as Admin first ![image](https://github.com/user-attachments/assets/93d3c461-a625-434b-8135-ddbfdb5988fb)
2. Navigate to Order and click New Order to create order![image](https://github.com/user-attachments/assets/40c20f8c-b508-4faa-9c0b-2ac253ec6343)
3. Fill out the form and click Create ![image](https://github.com/user-attachments/assets/48f530a3-f62e-45a2-9df0-15f2383ad4d9)
5. Log Out ![image](https://github.com/user-attachments/assets/c92251fb-9823-4d85-8ccd-bf3d84ad34c6)
6. Login as supervisor Navigate to order and approve here ![image](https://github.com/user-attachments/assets/236606f7-a21b-4be8-a96b-f8477c1a0600)
7. or click the order to View in detail ![image](https://github.com/user-attachments/assets/75b5b18c-b209-424c-a489-89659e5d5f07)
8. Once supervisor approved it will look like this ![image](https://github.com/user-attachments/assets/4f6368b1-a9c7-4904-a007-ccdf119da55f)
9. Login as ketua to final approvement ![image](https://github.com/user-attachments/assets/6dabb73b-5f33-414f-ae8f-3909970c93dc)
10. If one of the approvers rejected the whole proceess will be automaticly discarded and order will be rejected ![image](https://github.com/user-attachments/assets/1fba84a2-749c-447b-ae9c-ae8a296b4859)
11. by clicking on Approval status the Approval History will shown ![image](https://github.com/user-attachments/assets/ba151ca9-a698-4e48-8b21-756b55b6367b)
12. You can also Export the Orders table to XLX,XLS,or CSV by clicking the Export button and this prompt will show ![image](https://github.com/user-attachments/assets/6f01e4ab-2786-4e44-802b-f16d3006e5be)


### Edit approval flow
1. Login as Admin and navigate to Approval Flows click on OrderApproval ![image](https://github.com/user-attachments/assets/174b50a0-4687-41ca-9bfc-743794c380b8)
2. Add the step and adjust the order as needed ![image](https://github.com/user-attachments/assets/6bee479e-9510-4025-92ac-cdc6a6d56830)

## Contributing
Contributions are welcome! Please open an issue or submit a pull request for any improvements or bug fixes.

## Acknowledgements
- [pxlrbt/filament-excel](https://github.com/pxlrbt/filament-excel)
- [filament-approvals](https://github.com/eighty9nine/filament-approvals)
- [Filament](https://github.com/filamentphp/filament)
- [Laravel](https://github.com/laravel/laravel)
