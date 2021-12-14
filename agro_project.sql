-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2020 at 11:39 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agro_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `pro_grn`
--

CREATE TABLE `pro_grn` (
  `p_id` varchar(10) NOT NULL,
  `grn_no` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `qty` int(8) DEFAULT NULL,
  `unit_pri` double(10,2) DEFAULT NULL,
  `sel_pri` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pro_grn`
--

INSERT INTO `pro_grn` (`p_id`, `grn_no`, `qty`, `unit_pri`, `sel_pri`) VALUES
('P00001', 'G00001', 25, 40.00, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cat`
--

CREATE TABLE `tbl_cat` (
  `cat_id` varchar(10) NOT NULL,
  `cat` varchar(45) DEFAULT NULL,
  `state` varchar(8) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cat`
--

INSERT INTO `tbl_cat` (`cat_id`, `cat`, `state`) VALUES
('C00001', 'Plants', 'Active'),
('C00002', 'Fertilizer', 'Active'),
('C00003', 'Seeds', 'Active'),
('C00004', 'Equipment', 'Active'),
('C00005', 'Animal Feed', 'Active'),
('C00006', 'Others', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_crt`
--

CREATE TABLE `tbl_crt` (
  `crt_id` int(10) NOT NULL,
  `cus_id` varchar(45) DEFAULT NULL,
  `p_id` varchar(45) DEFAULT NULL,
  `m_no` varchar(100) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `sel_pri` double(10,2) DEFAULT NULL,
  `sub_total` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cus_id` varchar(10) NOT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_no` varchar(10) DEFAULT NULL,
  `user_status` varchar(8) DEFAULT 'Active',
  `u_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cus_id`, `f_name`, `l_name`, `address`, `contact_no`, `user_status`, `u_id`) VALUES
('C00000', 'Cash ', 'Customer', NULL, NULL, 'Active', 'U00001'),
('C00001', 'Afrath', 'Nawaz', 'Mawanella', '0770000011', 'Active', 'U00003');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cus_ord`
--

CREATE TABLE `tbl_cus_ord` (
  `cus_ord_no` varchar(10) NOT NULL,
  `cus_id` varchar(10) NOT NULL,
  `ordate` date DEFAULT NULL,
  `order_type` varchar(45) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cus_ord`
--

INSERT INTO `tbl_cus_ord` (`cus_ord_no`, `cus_id`, `ordate`, `order_type`, `status`) VALUES
('O00001', 'C00000', '2020-09-03', 'walking order', 1),
('O00002', 'C00001', '2020-09-04', 'walking order', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `emp_id` varchar(10) NOT NULL,
  `emp_name` varchar(45) DEFAULT NULL,
  `addr` varchar(200) DEFAULT NULL,
  `cont` varchar(10) DEFAULT NULL,
  `user_status` varchar(8) DEFAULT 'Active',
  `u_id` varchar(10) NOT NULL,
  `role_id` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`emp_id`, `emp_name`, `addr`, `cont`, `user_status`, `u_id`, `role_id`) VALUES
('E00000', 'M.S.M. Silmy', 'M.S.M. Agro Mart', '0774678849', 'Active', 'U00000', 'R00000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_e_role`
--

CREATE TABLE `tbl_e_role` (
  `role_id` varchar(8) NOT NULL,
  `role_name` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_e_role`
--

INSERT INTO `tbl_e_role` (`role_id`, `role_name`, `state`) VALUES
('R00000', 'Admin', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn`
--

CREATE TABLE `tbl_grn` (
  `grn_no` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `grn_date` date DEFAULT NULL,
  `ref_no` varchar(45) DEFAULT NULL,
  `sup_id` varchar(10) NOT NULL,
  `po_no` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_grn`
--

INSERT INTO `tbl_grn` (`grn_no`, `grn_date`, `ref_no`, `sup_id`, `po_no`) VALUES
('G00001', '2020-09-03', 'zefto0001', 'S00001', 'P00001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_no` varchar(10) NOT NULL,
  `payment_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ord_info`
--

CREATE TABLE `tbl_ord_info` (
  `p_id` varchar(10) NOT NULL,
  `itm_code` varchar(45) DEFAULT NULL,
  `itm_qty` int(11) DEFAULT NULL,
  `sel_pri` decimal(10,0) DEFAULT NULL,
  `sub_tot` decimal(10,2) DEFAULT NULL,
  `cus_ord_no` varchar(10) NOT NULL,
  `state` varchar(45) DEFAULT 'sold'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_ord_info`
--

INSERT INTO `tbl_ord_info` (`p_id`, `itm_code`, `itm_qty`, `sel_pri`, `sub_tot`, `cus_ord_no`, `state`) VALUES
('P00001', 'zefto0001', 20, '50', '1000.00', 'O00001', 'sold'),
('P00001', 'chilli002', 1, '50', '50.00', 'O00002', 'sold');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(8) NOT NULL,
  `gtot` double(10,2) DEFAULT NULL,
  `dis` int(2) DEFAULT '0',
  `ntot` double(10,2) DEFAULT NULL,
  `amt` double(10,2) DEFAULT NULL,
  `bal` double(10,2) DEFAULT '0.00',
  `p_m_id` varchar(10) NOT NULL,
  `cus_ord_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `gtot`, `dis`, `ntot`, `amt`, `bal`, `p_m_id`, `cus_ord_no`) VALUES
(1, 1000.00, 0, 1000.00, 1000.00, 0.00, 'P00001', 'O00001'),
(2, 50.00, 0, 50.00, 50.00, 0.00, 'P00001', 'O00002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_types`
--

CREATE TABLE `tbl_payment_types` (
  `p_m_id` varchar(10) NOT NULL,
  `payment_method` varchar(45) DEFAULT NULL,
  `state` varchar(8) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payment_types`
--

INSERT INTO `tbl_payment_types` (`p_m_id`, `payment_method`, `state`) VALUES
('P00001', 'Cash', 'Active'),
('P00002', 'Card', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_po_items`
--

CREATE TABLE `tbl_po_items` (
  `p_id` varchar(10) NOT NULL,
  `po_no` varchar(8) NOT NULL,
  `qty` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_po_items`
--

INSERT INTO `tbl_po_items` (`p_id`, `po_no`, `qty`) VALUES
('P00001', 'P00001', 25);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `p_id` varchar(10) NOT NULL,
  `sub_cat_id` varchar(10) NOT NULL,
  `model_number` varchar(45) DEFAULT NULL,
  `description` varchar(450) DEFAULT NULL,
  `re_ord_qty` varchar(8) DEFAULT NULL,
  `state` varchar(45) DEFAULT 'Active',
  `tot_qty` int(11) DEFAULT '0',
  `sell_price` double(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`p_id`, `sub_cat_id`, `model_number`, `description`, `re_ord_qty`, `state`, `tot_qty`, `sell_price`) VALUES
('P00001', 'S00001', 'Chilli Plant', 'Spice up your cooking with Chillies, the ideal crop for growing-bags and pots.', '10', 'Active', 4, 50.00),
('P00002', 'S00005', 'Love Birds Feed- Pellets', 'the perfect addition to the nutrients love birds are getting from their other food', '5', 'Active', 0, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pur_ord`
--

CREATE TABLE `tbl_pur_ord` (
  `po_no` varchar(8) NOT NULL,
  `sup_id` varchar(10) NOT NULL,
  `po_date` date DEFAULT NULL,
  `ship_date` date DEFAULT NULL,
  `state` varchar(10) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_pur_ord`
--

INSERT INTO `tbl_pur_ord` (`po_no`, `sup_id`, `po_date`, `ship_date`, `state`) VALUES
('P00001', 'S00001', '2020-09-03', '2020-09-03', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_return`
--

CREATE TABLE `tbl_return` (
  `return_id` varchar(8) NOT NULL,
  `r_date` varchar(45) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `cus_ord_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_return_items`
--

CREATE TABLE `tbl_return_items` (
  `p_id` varchar(10) NOT NULL,
  `reason` varchar(45) DEFAULT NULL,
  `return_id` varchar(8) NOT NULL,
  `cus_ord_no` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_return_new_itms`
--

CREATE TABLE `tbl_return_new_itms` (
  `RT` int(10) NOT NULL,
  `promo_price` varchar(45) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `p_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcat`
--

CREATE TABLE `tbl_subcat` (
  `sub_cat_id` varchar(10) NOT NULL,
  `sub_cat` varchar(45) DEFAULT NULL,
  `state` varchar(8) DEFAULT 'Active',
  `cat_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_subcat`
--

INSERT INTO `tbl_subcat` (`sub_cat_id`, `sub_cat`, `state`, `cat_id`) VALUES
('S00001', 'Vegetable Plants', 'Active', 'C00001'),
('S00002', 'Fruit Plants', 'Active', 'C00001'),
('S00003', 'Flower Plants', 'Active', 'C00001'),
('S00004', 'Roughages', 'Active', 'C00005'),
('S00005', 'Concentrates', 'Active', 'C00005'),
('S00006', 'Mixed Feed', 'Active', 'C00005');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `sup_id` varchar(10) NOT NULL,
  `sup_name` varchar(50) DEFAULT NULL,
  `comp_name` varchar(45) DEFAULT NULL,
  `comp_addr` varchar(100) DEFAULT NULL,
  `contact` varchar(10) DEFAULT NULL,
  `user_status` varchar(8) DEFAULT 'Active',
  `u_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`sup_id`, `sup_name`, `comp_name`, `comp_addr`, `contact`, `user_status`, `u_id`) VALUES
('S00001', 'Fazlur', 'Zefto', 'No 35, School road, Kirungadeniya, Mawanella', '0770089800', 'Active', 'U00002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `u_id` varchar(10) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pwd` varchar(32) DEFAULT NULL,
  `conpwd` varchar(32) DEFAULT NULL,
  `state` varchar(8) DEFAULT '1',
  `user_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`u_id`, `email`, `pwd`, `conpwd`, `state`, `user_type`) VALUES
('U00000', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '1', 0),
('U00001', NULL, NULL, NULL, '1', 1),
('U00002', 'sfazlurrahmanrs@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '1', 2),
('U00003', 'afrath@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pro_grn`
--
ALTER TABLE `pro_grn`
  ADD KEY `fk_pro_grn_tbl_product1_idx` (`p_id`),
  ADD KEY `fk_pro_grn_tbl_grn1_idx` (`grn_no`);

--
-- Indexes for table `tbl_cat`
--
ALTER TABLE `tbl_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_crt`
--
ALTER TABLE `tbl_crt`
  ADD PRIMARY KEY (`crt_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cus_id`),
  ADD KEY `fk_tbl_customer_tbl_user1_idx` (`u_id`);

--
-- Indexes for table `tbl_cus_ord`
--
ALTER TABLE `tbl_cus_ord`
  ADD PRIMARY KEY (`cus_ord_no`),
  ADD KEY `fk_tbl_cus_ord_tbl_customer1_idx` (`cus_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `fk_tbl_employee_tbl_user1_idx` (`u_id`),
  ADD KEY `fk_tbl_employee_tbl_e_role1_idx` (`role_id`);

--
-- Indexes for table `tbl_e_role`
--
ALTER TABLE `tbl_e_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_grn`
--
ALTER TABLE `tbl_grn`
  ADD PRIMARY KEY (`grn_no`),
  ADD KEY `fk_tbl_grn_tbl_supplier1_idx` (`sup_id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_no`),
  ADD KEY `fk_tbl_invoice_tbl_payment1_idx` (`payment_id`);

--
-- Indexes for table `tbl_ord_info`
--
ALTER TABLE `tbl_ord_info`
  ADD KEY `fk_tbl_ord_info_tbl_product1_idx` (`p_id`),
  ADD KEY `fk_tbl_ord_info_tbl_cus_ord1_idx` (`cus_ord_no`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`,`p_m_id`),
  ADD KEY `fk_tbl_payment_tbl_payment_types1_idx` (`p_m_id`),
  ADD KEY `fk_tbl_payment_tbl_cus_ord1_idx` (`cus_ord_no`);

--
-- Indexes for table `tbl_payment_types`
--
ALTER TABLE `tbl_payment_types`
  ADD PRIMARY KEY (`p_m_id`);

--
-- Indexes for table `tbl_po_items`
--
ALTER TABLE `tbl_po_items`
  ADD KEY `fk_tbl_po_items_tbl_product1_idx` (`p_id`),
  ADD KEY `fk_tbl_po_items_tbl_pur_ord1_idx` (`po_no`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `fk_tbl_product_tbl_subcat1_idx` (`sub_cat_id`);

--
-- Indexes for table `tbl_pur_ord`
--
ALTER TABLE `tbl_pur_ord`
  ADD PRIMARY KEY (`po_no`),
  ADD KEY `fk_tbl_pur_ord_tbl_supplier1_idx` (`sup_id`);

--
-- Indexes for table `tbl_return`
--
ALTER TABLE `tbl_return`
  ADD PRIMARY KEY (`return_id`),
  ADD KEY `fk_tbl_return_tbl_cus_ord1_idx` (`cus_ord_no`);

--
-- Indexes for table `tbl_return_items`
--
ALTER TABLE `tbl_return_items`
  ADD KEY `fk_tbl_return_items_tbl_product1_idx` (`p_id`),
  ADD KEY `fk_tbl_return_items_tbl_return1_idx` (`return_id`);

--
-- Indexes for table `tbl_return_new_itms`
--
ALTER TABLE `tbl_return_new_itms`
  ADD PRIMARY KEY (`RT`),
  ADD KEY `fk_tbl_return_new_itms_tbl_product1_idx` (`p_id`);

--
-- Indexes for table `tbl_subcat`
--
ALTER TABLE `tbl_subcat`
  ADD PRIMARY KEY (`sub_cat_id`),
  ADD KEY `fk_tbl_subcat_tbl_cat1_idx` (`cat_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`sup_id`),
  ADD KEY `fk_tbl_supplier_tbl_user1_idx` (`u_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_crt`
--
ALTER TABLE `tbl_crt`
  MODIFY `crt_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_return_new_itms`
--
ALTER TABLE `tbl_return_new_itms`
  MODIFY `RT` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pro_grn`
--
ALTER TABLE `pro_grn`
  ADD CONSTRAINT `fk_pro_grn_tbl_grn1` FOREIGN KEY (`grn_no`) REFERENCES `tbl_grn` (`grn_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pro_grn_tbl_product1` FOREIGN KEY (`p_id`) REFERENCES `tbl_product` (`p_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD CONSTRAINT `fk_tbl_customer_tbl_user1` FOREIGN KEY (`u_id`) REFERENCES `tbl_user` (`u_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_cus_ord`
--
ALTER TABLE `tbl_cus_ord`
  ADD CONSTRAINT `fk_tbl_cus_ord_tbl_customer1` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customer` (`cus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD CONSTRAINT `fk_tbl_employee_tbl_e_role1` FOREIGN KEY (`role_id`) REFERENCES `tbl_e_role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_employee_tbl_user1` FOREIGN KEY (`u_id`) REFERENCES `tbl_user` (`u_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_grn`
--
ALTER TABLE `tbl_grn`
  ADD CONSTRAINT `fk_tbl_grn_tbl_supplier1` FOREIGN KEY (`sup_id`) REFERENCES `tbl_supplier` (`sup_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD CONSTRAINT `fk_tbl_invoice_tbl_payment1` FOREIGN KEY (`payment_id`) REFERENCES `tbl_payment` (`payment_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_ord_info`
--
ALTER TABLE `tbl_ord_info`
  ADD CONSTRAINT `fk_tbl_ord_info_tbl_cus_ord1` FOREIGN KEY (`cus_ord_no`) REFERENCES `tbl_cus_ord` (`cus_ord_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_ord_info_tbl_product1` FOREIGN KEY (`p_id`) REFERENCES `tbl_product` (`p_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `fk_tbl_payment_tbl_cus_ord1` FOREIGN KEY (`cus_ord_no`) REFERENCES `tbl_cus_ord` (`cus_ord_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_payment_tbl_payment_types1` FOREIGN KEY (`p_m_id`) REFERENCES `tbl_payment_types` (`p_m_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_po_items`
--
ALTER TABLE `tbl_po_items`
  ADD CONSTRAINT `fk_tbl_po_items_tbl_product1` FOREIGN KEY (`p_id`) REFERENCES `tbl_product` (`p_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_po_items_tbl_pur_ord1` FOREIGN KEY (`po_no`) REFERENCES `tbl_pur_ord` (`po_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `fk_tbl_product_tbl_subcat1` FOREIGN KEY (`sub_cat_id`) REFERENCES `tbl_subcat` (`sub_cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_pur_ord`
--
ALTER TABLE `tbl_pur_ord`
  ADD CONSTRAINT `fk_tbl_pur_ord_tbl_supplier1` FOREIGN KEY (`sup_id`) REFERENCES `tbl_supplier` (`sup_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_return`
--
ALTER TABLE `tbl_return`
  ADD CONSTRAINT `fk_tbl_return_tbl_cus_ord1` FOREIGN KEY (`cus_ord_no`) REFERENCES `tbl_cus_ord` (`cus_ord_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_return_items`
--
ALTER TABLE `tbl_return_items`
  ADD CONSTRAINT `fk_tbl_return_items_tbl_product1` FOREIGN KEY (`p_id`) REFERENCES `tbl_product` (`p_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_return_items_tbl_return1` FOREIGN KEY (`return_id`) REFERENCES `tbl_return` (`return_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_return_new_itms`
--
ALTER TABLE `tbl_return_new_itms`
  ADD CONSTRAINT `fk_tbl_return_new_itms_tbl_product1` FOREIGN KEY (`p_id`) REFERENCES `tbl_product` (`p_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_subcat`
--
ALTER TABLE `tbl_subcat`
  ADD CONSTRAINT `fk_tbl_subcat_tbl_cat1` FOREIGN KEY (`cat_id`) REFERENCES `tbl_cat` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD CONSTRAINT `fk_tbl_supplier_tbl_user1` FOREIGN KEY (`u_id`) REFERENCES `tbl_user` (`u_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
