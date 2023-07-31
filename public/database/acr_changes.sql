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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

ALTER TABLE `shop_categories` ADD `image` TEXT NULL AFTER `name`;
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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

