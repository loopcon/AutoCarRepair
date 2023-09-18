-- Disha : 28-07-2023 12:30 PM

-- Table structure for table `fuel_type`
--

CREATE TABLE `fuel_type` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(1) DEFAULT 1 COMMENT '0=Yes,1=No',
  `status` tinyint(1) DEFAULT 0 COMMENT '0="In Active";1="Active"	',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `fuel_type`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `fuel_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- khushali : 28-07-2023 12:33 PM
--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` int(11) NOT NULL,
  `slug` int(11) DEFAULT NULL,
  `title` int(11) DEFAULT NULL,
  `image` int(11) DEFAULT NULL,
  `is_archive` tinyint(1) DEFAULT 1 COMMENT '1=No;0=Yes',
  `status` tinyint(1) DEFAULT 0 COMMENT '0="InActive";1="Active"',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `service_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


-- Disha : 28-07-2023 01:03 PM

ALTER TABLE `service_categories` CHANGE `slug` `slug` VARCHAR(255) NULL DEFAULT NULL, CHANGE `title` `title` VARCHAR(225) NULL DEFAULT NULL, CHANGE `image` `image` VARCHAR(255) NULL DEFAULT NULL;

--Nirali : 28-07-2023 03:43 PM
--
-- Table structure for table `shop_categories`
--

CREATE TABLE `shop_categories` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=Yes,1=No',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0="InActive";1="Active"',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `shop_categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `shop_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `shop_categories` ADD `image` TEXT NULL AFTER `name`;

-- Disha : 28-07-2023 04:24 PM

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `slug` text DEFAULT NULL,
  `shop_category_id` int(11) DEFAULT NULL COMMENT '`id` of `shop_categories`',
  `name` text DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `specification` text DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `amazon_link` text DEFAULT NULL,
  `flipcart_link` text DEFAULT NULL,
  `is_archive` tinyint(1) DEFAULT 1 COMMENT '0=Yes;1=No	',
  `status` tinyint(1) DEFAULT 1 COMMENT '0="In Active";1="Active"	',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


-- Nirali : 31-07-2023 03:20 PM

-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_archive` tinyint(4) DEFAULT 0 COMMENT '0=No;1=Yes',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;



--Nirali : 31-07-2023 04:03 PM

-- Table structure for table `enquires`
--

CREATE TABLE `enquires` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(1) DEFAULT 1 COMMENT '0=Yes,1=No',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `enquires`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `enquires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `enquires` CHANGE `phone` `phone` BIGINT(10) NULL DEFAULT NULL;


-- Nirali : 31-07-2023 05:55 PM
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `zipcode` bigint(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0="InActive";1="Active"	',
  `is_archive` tinyint(1) DEFAULT 1 COMMENT '0=Yes,1=No',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 31-07-2023 04:30 PM
--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `product_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `alt_text` char(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `is_primary` enum('yes','no') DEFAULT NULL COMMENT '1=Yes,0=No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `product_images`
  ADD PRIMARY KEY (`product_id`);

ALTER TABLE `product_images`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 31-07-2023 04:50 PM
--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `section1_title1` varchar(255) DEFAULT NULL,
  `section1_title2` varchar(255) DEFAULT NULL,
  `section1_image` varchar(255) DEFAULT NULL,
  `section1_description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 31-07-2023 05:12 PM

RENAME TABLE `acr`.`content` TO `acr`.`home_page_setting`;


-- Disha : 01-08-2023 11:03 PM

ALTER TABLE `service_categories` ADD `image_1` VARCHAR(255) NULL DEFAULT NULL AFTER `image`;
ALTER TABLE `service_categories` ADD `description` TEXT NULL DEFAULT NULL AFTER `image_1`;

-- Khushali : 29-07-2023 11:21 AM
ALTER TABLE `service_categories` CHANGE `status` `status` TINYINT(1) NULL DEFAULT '1' COMMENT '0=\"InActive\";1=\"Active\"';

ALTER TABLE `fuel_type` CHANGE `status` `status` TINYINT(1) NULL DEFAULT '1' COMMENT '0=\"In Active\";1=\"Active\" ';

-- Khushali : 01-08-2023 12:24 AM
--
-- Table structure for table `sceduled_packages`
--

CREATE TABLE `sceduled_packages` (
  `id` int(11) NOT NULL,
  `sc_id` int(11) DEFAULT NULL COMMENT '`id` of `service_categories`',
  `brand_id` int(11) DEFAULT NULL COMMENT '`id` of `car_brands`',
  `model_id` int(11) DEFAULT NULL COMMENT '`id` of `model`',
  `fuel_type_id` int(11) DEFAULT NULL COMMENT '`id` of `fuel_type`',
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `image_other` text DEFAULT NULL,
  `warrenty_info` text DEFAULT NULL,
  `recommended_info` text DEFAULT NULL,
  `time_takes` int(11) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `is_archive` tinyint(1) DEFAULT 1 COMMENT '1=No;0=Yes	',
  `status` tinyint(1) DEFAULT 1 COMMENT '0="InActive";1="Active"',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `sceduled_packages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sceduled_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Table structure for table `package_specification`
--

CREATE TABLE `package_specification` (
  `id` int(11) NOT NULL,
  `sp_id` int(11) DEFAULT NULL COMMENT '`id` of `scheduled_packages`',
  `specification` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `package_specification`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `package_specification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


-- Nirali : 01-08-2023 07:06 PM
ALTER TABLE `home_page_setting` ADD `meta_title` VARCHAR(255) NULL AFTER `section1_description`;
ALTER TABLE `home_page_setting` ADD `meta_keywords` TEXT NULL AFTER `meta_title`;
ALTER TABLE `home_page_setting` ADD `meta_description` TEXT NULL AFTER `meta_keywords`;

-- Khushali : 01-08-2023 1:51 PM
ALTER TABLE `shop_categories` CHANGE `status` `status` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '0=\"InActive\";1=\"Active\"';

ALTER TABLE `product_images` CHANGE `product_id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `product_images` ADD `product_id` INT NULL COMMENT '`id` of `products`' AFTER `id`;
ALTER TABLE `product_images`
  DROP `alt_text`,
  DROP `title`;
ALTER TABLE `product_images` CHANGE `is_primary` `is_primary` TINYINT(1) NULL DEFAULT NULL COMMENT '1=Yes,0=No';

-- Khushali : 02-08-2023 1:40 AM
ALTER TABLE `home_page_setting` ADD `footer_description` TEXT NULL AFTER `meta_description`;

-- Disha : 02-08-2023 3:43 PM
ALTER TABLE `service_categories` ADD `meta_title` VARCHAR(255) NULL DEFAULT NULL AFTER `description`, ADD `meta_keywords` TEXT NULL DEFAULT NULL AFTER `meta_title`, ADD `meta_description` TEXT NULL DEFAULT NULL AFTER `meta_keywords`;

ALTER TABLE `sceduled_packages` ADD `meta_title` VARCHAR(255) NULL DEFAULT NULL AFTER `price`, ADD `meta_keywords` TEXT NULL DEFAULT NULL AFTER `meta_title`, ADD `meta_description` TEXT NULL DEFAULT NULL AFTER `meta_keywords`;

ALTER TABLE `products` ADD `meta_title` VARCHAR(255) NULL DEFAULT NULL AFTER `flipcart_link`, ADD `meta_keywords` TEXT NULL DEFAULT NULL AFTER `meta_title`, ADD `meta_description` TEXT NULL DEFAULT NULL AFTER `meta_keywords`;

-- Disha : 03-08-2023 9:41 AM
ALTER TABLE `fuel_type` ADD `image` VARCHAR(255) NULL DEFAULT NULL AFTER `slug`;

ALTER TABLE `sceduled_packages` ADD `note` VARCHAR(255) NULL DEFAULT NULL AFTER `recommended_info`;

-- Disha : 03-08-2023 3:51 PM
--
-- Table structure for table `service_center_detail`
--
CREATE TABLE `service_center_detail` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `phone number` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `service_center_detail`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `service_center_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `service_center_detail` CHANGE `phone number` `phone_number` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

-- Disha : 03-08-2023 4:36 PM
ALTER TABLE `service_center_detail` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `updated_at` `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `service_center_detail` CHANGE `updated_by` `updated_by` INT(11) NULL DEFAULT NULL;

-- Disha : 04-08-2023 4:34 PM
ALTER TABLE `users` ADD `visible_password` VARCHAR(255) NULL DEFAULT NULL AFTER `password`;

-- Disha : 04-08-2023 13:15 PM
ALTER TABLE `users` ADD `remember_token` VARCHAR(255) NULL DEFAULT NULL AFTER `zipcode`;

-- Khushali : 07-08-2023 11:33 AM
CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT '`id` of `users`',
  `product_id` int(11) DEFAULT NULL COMMENT '`id` of `products`',
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT '`id` of `users`',
  `is_guest_chekout` tinyint(1) DEFAULT NULL COMMENT '0=no;1=yes',
  `payment_type` tinyint(1) DEFAULT NULL COMMENT '0=online;1=offline',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL COMMENT '`id` of `orders`',
  `product_id` int(11) DEFAULT NULL COMMENT '`id` of `products`',
  `price` decimal(15,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Khushali : 07-08-2023 11:55 AM
ALTER TABLE `users` CHANGE `status` `status` TINYINT(1) NULL DEFAULT '1' COMMENT '0=\"InActive\";1=\"Active\" ';

-- Khushali : 07-08-2023 1:12 AM
CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '`id` of `users`',
  `address` text DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Khushali : 07-08-2023 2:01 PM
ALTER TABLE `car_brands` CHANGE `status` `status` TINYINT(1) NULL DEFAULT '1' COMMENT '0=\"In Active\";1=\"Active\" ';

ALTER TABLE `model` ADD `image` TEXT NULL AFTER `title`;

-- Nirali : 08-08-2023 4:25 PM
ALTER TABLE `home_page_setting` ADD `button_title` VARCHAR(255) NULL AFTER `footer_description`, ADD `button_link` VARCHAR(255) NULL AFTER `button_title`;

-- Disha : 09-08-2023 2:25 PM
ALTER TABLE `user_addresses` ADD `state` VARCHAR(255) NULL DEFAULT NULL AFTER `city`;

-- khushali : 09-8-2023 12:05 PM
ALTER TABLE `cart` ADD `service_id` INT NULL COMMENT '`id` of `sceduled_package`' AFTER `product_id`;
ALTER TABLE `order_details` ADD `service_id` INT NULL COMMENT '`id` of `sceduled_packages`' AFTER `product_id`;

-- khushali : 10-08-2023 3:08 PM
--
-- Table structure for table `pick_up_slot_settings`
--

CREATE TABLE `pick_up_slot_settings` (
  `id` int(11) NOT NULL,
  `slot` tinyint(1) DEFAULT NULL COMMENT '0=Evening;1=Afternoon',
  `time` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `pick_up_slot_settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pick_up_slot_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 10-08-2023 9:50 AM
--
-- Table structure for table `offer_slider`
--
CREATE TABLE `offer_slider` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title1` varchar(255) DEFAULT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `btn_title` varchar(255) DEFAULT NULL,
  `btn_link` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=Yes;1=No',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `offer_slider`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `offer_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Khushali : 11-08-2023 3:14 PM
--
-- Table structure for table `booked_slots`
--

CREATE TABLE `booked_slots` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT '`id` of `users`',
  `order_id` int(11) DEFAULT NULL COMMENT '`id` of `orders`',
  `order_detail_id` int(11) DEFAULT NULL COMMENT '`id` of `order_details`',
  `service_id` int(11) DEFAULT NULL COMMENT '`id` of `scheduled_packages`',
  `slot_date` date DEFAULT NULL,
  `pick_up_time1` varchar(100) DEFAULT NULL,
  `pick_up_time2` varchar(100) DEFAULT NULL,
  `time_type` tinyint(1) DEFAULT NULL COMMENT '0=AM;1=PM',
  `time_takes` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `booked_slots`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `booked_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 11-08-2023 2:21 PM
--
-- Table structure for table `brand_logo_slider`
--

CREATE TABLE `brand_logo_slider` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `brand_logo_slider`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `brand_logo_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Khushali : 12-8-23 11:18 AM
ALTER TABLE `orders` ADD `invoice_no` VARCHAR(100) NULL AFTER `id`;

-- Khushali : 14-08-2023 3:41 PM
INSERT INTO `settings` (`id`, `name`, `label`, `value`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES (NULL, 'Product Gst(%)', 'product_gst', NULL, NULL, current_timestamp(), NULL, current_timestamp());

INSERT INTO `settings` (`id`, `name`, `label`, `value`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES (NULL, 'Service Gst(%)', 'service_gst', NULL, NULL, current_timestamp(), NULL, current_timestamp());

ALTER TABLE `orders` ADD `subtotal` DECIMAL(15,2) NULL AFTER `city`, ADD `product_gst` DECIMAL(15, 2) NULL AFTER `subtotal`, ADD `service_gst` DECIMAL(15,2) NULL AFTER `product_gst`;
ALTER TABLE `orders` ADD `product_gst_rate` DECIMAL(15,2) NULL AFTER `subtotal`, ADD `service_gst_rate` DECIMAL(15, 2) NULL AFTER `product_gst_rate`;

ALTER TABLE `orders` CHANGE `is_complete` `is_complete` TINYINT(1) NULL DEFAULT '0' COMMENT '0=No;1=Yes;2=Cancel';
UPDATE `email_templates` SET `label` = 'cancel_order', `value` = 'Cancel Order' WHERE `email_templates`.`id` = 12;

-- Disha : 19-8-23 9:46 AM
ALTER TABLE `pick_up_slot_settings` CHANGE `slot` `slot` TINYINT(1) NULL DEFAULT NULL COMMENT '0=Evening;1=Afternoon;2=Morning';

-- Disha : 19-8-23 11:09 AM
ALTER TABLE `faq` ADD `service_category_id` INT(255) NULL DEFAULT NULL AFTER `id`;

-- Disha : 28-8-23 6:18 PM
ALTER TABLE `home_page_setting` ADD `image_title` VARCHAR(255) NULL DEFAULT NULL AFTER `section1_description`;

ALTER TABLE `offer_slider` ADD `image_title` VARCHAR(255) NULL DEFAULT NULL AFTER `image`;

ALTER TABLE `brand_logo_slider` ADD `image_title` VARCHAR(255) NULL DEFAULT NULL AFTER `image`;

-- Khushali : 29-08-2023 10:07 AM
ALTER TABLE `home_page_setting` ADD `price_list` LONGTEXT NULL AFTER `button_link`;

-- Disha : 31-8-23 10:16 PM
ALTER TABLE `service_center_detail` ADD `image_title` VARCHAR(255) NULL DEFAULT NULL AFTER `image`;

ALTER TABLE `shop_categories` ADD `image_title` VARCHAR(255) NULL DEFAULT NULL AFTER `image`;

ALTER TABLE `product_images` ADD `image_title` VARCHAR(255) NULL DEFAULT NULL AFTER `image`;

-- Disha : 31-8-23 1:56 PM
ALTER TABLE `service_categories` ADD `icon_image` VARCHAR(255) NULL DEFAULT NULL AFTER `image_1`;

-- Khushali : 31-08-23 11:12 AM
--
-- Table structure for table `scheduled_package_detail`
--

CREATE TABLE `scheduled_package_detail` (
  `id` int(11) NOT NULL,
  `sp_id` int(11) DEFAULT NULL COMMENT '`id` of `scheduled_packages`',
  `brand_id` int(11) DEFAULT NULL COMMENT '`id` of `car_brands`',
  `model_id` int(11) DEFAULT NULL COMMENT '`id` of `model`',
  `fuel_type_id` int(11) DEFAULT NULL COMMENT '`id` of `fuel_type`',
  `price` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `scheduled_package_detail`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `scheduled_package_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 1-9-23 11:04 AM
ALTER TABLE `service_categories` ADD `price_list` LONGTEXT NULL DEFAULT NULL AFTER `description`;

-- Disha : 2-9-23 9:42 AM
ALTER TABLE `pages` ADD `meta_title` VARCHAR(255) NULL DEFAULT NULL AFTER `is_archive`, ADD `extra_meta_tag` VARCHAR(255) NULL DEFAULT NULL AFTER `meta_title`;


-- Disha : 2-9-23 11:16 AM
-- Table structure for table `compny_cms_page`
--
CREATE TABLE `compny_cms_page` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `banner_text` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(1) DEFAULT 0 COMMENT '	0=No;1=Yes	',
  `meta_title` varchar(255) DEFAULT NULL,
  `extra_meta_tag` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `compny_cms_page`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `compny_cms_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 5-9-23 11:15 AM
ALTER TABLE `compny_cms_page` ADD `section` TINYINT(1) NULL DEFAULT NULL COMMENT '0=second;1=third;2=forth' AFTER `banner_text`;
ALTER TABLE `service_categories` ADD `order_by` INT(11) NOT NULL AFTER `is_archive`;

-- Dipak : 12-09-2023
ALTER TABLE `sceduled_packages` ADD `time_takes_option` ENUM('Day','Hour') NOT NULL DEFAULT 'Hour' AFTER `time_takes_day`;
ALTER TABLE `sceduled_packages` CHANGE `time_takes_day` `time_takes_day` INT(11) NULL;

CREATE TABLE `model_fueltype_transaction` (
  `id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `fuel_type_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `model_fueltype_transaction` ADD PRIMARY KEY (`id`);

ALTER TABLE `model_fueltype_transaction` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Riddhi: 16-09-2023

ALTER TABLE `users` ADD `password_active` INT(11) NOT NULL DEFAULT '1' AFTER `is_archive`;

ALTER TABLE `home_page_setting` ADD `extra_meta_tag` LONGTEXT NOT NULL AFTER `meta_description`;

-- Disha : 16-09-23 11:33 AM

-- Table structure for table `seo`
--
CREATE TABLE `seo` (
  `id` int(11) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `extra_meta_description` text NOT NULL,
  `is_archive` tinyint(1) DEFAULT 1 COMMENT '	0=Yes;1=No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `seo` (`id`, `meta_title`, `meta_keyword`, `meta_description`, `extra_meta_description`, `is_archive`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, '', 1, '2023-09-16 06:01:06', '2023-09-16 06:01:06'),
(2, NULL, NULL, NULL, '', 1, '2023-09-16 06:01:24', '2023-09-16 06:01:24'),
(3, NULL, NULL, NULL, '', 1, '2023-09-16 06:01:32', '2023-09-16 06:01:32'),
(4, NULL, NULL, NULL, '', 1, '2023-09-16 06:01:36', '2023-09-16 06:01:36');

ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
