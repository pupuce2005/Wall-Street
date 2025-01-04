CREATE DATABASE action
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;





CREATE TABLE public.action
(
    unik_id integer NOT NULL,
    id text NOT NULL,
    name text,
    currency text,
    PRIMARY KEY (unik_id)
);

ALTER TABLE IF EXISTS public.action
    OWNER to postgres;





CREATE TABLE public.purchase
(
    purchase_id integer NOT NULL,
    action_id text,
    purchase_date date,
    share_price double precision,
    share_number double precision,
    ht double precision,
    purchase_fees double precision,
    ttc double precision,
    purchase_change double precision,
    chf double precision,
    PRIMARY KEY (purchase_id)
);

ALTER TABLE IF EXISTS public.purchase
    OWNER to postgres;



CREATE TABLE public.sell
(
    sell_id integer NOT NULL,
    action_id text,
    sell_date date,
    share_price double precision,
    share_number double precision,
    ht double precision,
    sell_fees double precision,
    ttc double precision,
    sell_change double precision,
    chf double precision,
    PRIMARY KEY (sell_id)
);

ALTER TABLE IF EXISTS public.sell
    OWNER to postgres;



INSERT INTO public.action(
	unik_id, id, name, currency) VALUES
	(1,'AAPL','Apple','USD'),
	(2,'MSFT','Microsoft','USD'),
	(3,'TSM','TSMC','USD'),
	(4,'VUSD','S&P 500','USD'),
	(5,'ABBN','ABB','CHF'),
	(6,'NVDA','NVIDIA','USD'),
	(7,'MA','Mastercard','USD'),
	(8,'GOOG','Google','USD'),
	(9,'EQQQ','Nasdaq','USD'),
	(10,'LOGN','Logitech','CHF'),
    (11,'AXA','AXA SA','EUR'),
    (12,'CS.PA','Credit Agricole','EUR'),
    (13,'SPI','Swiss Performance Index','CHF'),
    (14,'BMW','BMW','EUR'),
    (15,'VW','VolksWagen','EUR');



INSERT INTO public.purchase(
	purchase_id, action_id, purchase_date, share_price, share_number, ht, purchase_fees, ttc, purchase_change, chf) VALUES 
	(1, 'AAPL', '2024-02-21', 182.37, 0.5, 91.185, 0.14, 91.325, 0.887978, 81.09),
	(2, 'MSFT', '2024-02-27', 406.13, 0.25, 101.53, 1.15, 102.68, 0.888139, 91.20),
	(3, 'VUSD', '2024-04-04', 99.0225, 1, 99.0225, 0.15, 99.17, 0.915059, 90.75),
	(4, 'TSM', '2024-05-02', 134.76, 0.25, 33.69, 0.05, 33.74, 0.922475, 31.12),
	(5, 'ABBN', '2024-06-03', 49.78, 2, 99.56, 0.05, 99.61, 1, 99.61),
	(6, 'NVDA', '2024-06-18', 135.92, 0.5, 67.96, 0.1, 68.06, 0.892713, 60.76),
	(7, 'MA', '2024-06-20', 451.21, 0.1, 45.121, 0.07, 45.191, 0.893106, 40.36),
	(8, 'GOOG', '2024-07-12', 187.72, 0.5, 93.86, 1.14, 95, 0.903012, 85.79),
	(9, 'EQQQ', '2024-08-08', 438.50, 0.2, 87.7, 1.13, 88.83, 0.866948, 77.01),
	(10, 'LOGN', '2024-08-09', 74.32, 0.5, 37.16, 1.05, 38.21, 1, 38.21),
    (11, 'AXA', '2024-08-27', 34.14, 3, 102.42, 1.46, 103.88, 0.954285, 99.13),
    (12, 'CS.PA', '2024-10-04', 13.57, 7.4, 101.42, 1.45, 101.87, 0.947408, 96.51),
    (13, 'SPI', '2024-10-28', 145.65, 1, 145.65, 1.10, 146.75, 1, 146.75),
    (14, 'BMW', '2024-12-20', 76.44, 1, 76.44, 1.11, 77.55, 0.940268, 72.92),
    (15, 'VW', '2024-12-20', 88.55, 1, 88.55, 1.13, 89.68, 0.940268, 84.32);


INSERT INTO public.sell(
	sell_id, action_id, sell_date, share_price, share_number, ht, sell_fees, ttc, sell_change, chf) VALUES 
	(1, 'TSM', '2024-10-18', 202.89, 0.25, 50.72, 1.08, 49.64, 1, 49.64),
    (2, 'AAPL', '2024-12-11', 249.36, 0.5, 124.68, 1.19, 123.49, 1, 123.49),
    (3, 'GOOG', '2024-12-11', 196.20, 0.5, 98.10, 1.15, 96.95, 1, 96.95);