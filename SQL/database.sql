-- Create the Database
CREATE DATABASE IF NOT EXISTS LPA_eComms;

-- Use the database
USE LPA_eComms;

-- Create the 'lpa_stock' table
CREATE TABLE IF NOT EXISTS lpa_stock (
    lpa_stock_ID VARCHAR(20) PRIMARY KEY,
    lpa_stock_name VARCHAR(250),
    lpa_stock_desc TEXT,
    lpa_stock_onhand VARCHAR(5),
    lpa_stock_price DECIMAL(7,2),
    lpa_stock_status CHAR(1)
);

-- Create the 'lpa_clients' table
CREATE TABLE IF NOT EXISTS lpa_clients (
    lpa_client_ID VARCHAR(20) PRIMARY KEY,
    lpa_client_firstname VARCHAR(50),
    lpa_client_lastname VARCHAR(50),
    lpa_client_address VARCHAR(250),
    lpa_client_phone VARCHAR(30),
    lpa_client_status CHAR(1)
);

--  Create the 'lpa_invoices' table
CREATE TABLE IF NOT EXISTS lpa_invoices (
    lpa_inv_no VARCHAR(20) PRIMARY KEY,
    lpa_inv_date DATETIME,
    lpa_inv_client_ID VARCHAR(20),
    lpa_inv_client_name VARCHAR(50),
    lpa_inv_client_address VARCHAR(250),
    lpa_inv_amount DECIMAL(8,2),
    lpa_inv_status CHAR(1)
);

--  Create the 'lpa_invoice_items' table
CREATE TABLE IF NOT EXISTS lpa_invoice_items (
    lpa_invitem_no VARCHAR(20) PRIMARY KEY,
    lpa_invitem_inv_no VARCHAR(20),
    lpa_invitem_stock_ID VARCHAR(20),
    lpa_invitem_stock_name VARCHAR(250),
    lpa_invitem_qty VARCHAR(6),
    lpa_invitem_stock_price DECIMAL(7,2),
    lpa_invitem_stock_amount DECIMAL(7,2),
    lpa_inv_status CHAR(1)
);

--  Create the 'lpa_users' table
CREATE TABLE IF NOT EXISTS lpa_users (
    lpa_user_ID VARCHAR(20) PRIMARY KEY,
    lpa_user_username VARCHAR(30),
    lpa_user_password VARCHAR(50),
    lpa_user_firstname VARCHAR(50),
    lpa_user_lastname VARCHAR(50),
    lpa_user_group VARCHAR(50),
    lpa_inv_status CHAR(1)
);