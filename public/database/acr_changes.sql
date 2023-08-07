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
