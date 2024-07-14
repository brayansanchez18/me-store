-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 28-05-2024 a las 14:32:00
-- Versión del servidor: 8.0.36-28
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbnqcso7svf0mw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id_admin` int NOT NULL,
  `rol_admin` text,
  `name_admin` text,
  `email_admin` text,
  `password_admin` text,
  `token_admin` text,
  `token_exp_admin` text,
  `date_created_admin` date DEFAULT NULL,
  `date_updated_admin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id_admin`, `rol_admin`, `name_admin`, `email_admin`, `password_admin`, `token_admin`, `token_exp_admin`, `date_created_admin`, `date_updated_admin`) VALUES
(1, 'admin', 'Jose Tienda', 'admin@ecommerce.com', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MTY4NDk2OTcsImV4cCI6MTcxNjkzNjA5NywiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6ImFkbWluQGVjb21tZXJjZS5jb20ifX0.YQFjMlJoZf3QzCHxT6KKgDsd1L6MqBdwLOhC9ZGHHg4', '1716936097', '2022-09-21', '2024-05-28 14:31:36'),
(3, 'editor', 'Juan Editor', 'editor@ecommerce.com', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MTY4NTEwMDAsImV4cCI6MTcxNjkzNzQwMCwiZGF0YSI6eyJpZCI6IjMiLCJlbWFpbCI6ImVkaXRvckBlY29tbWVyY2UuY29tIn19.HOzoTXcQDEkjEATdFeM2EjWOts3p7U6L45aj444WRrk', '1716937400', '2024-05-27', '2024-05-27 23:05:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE `banners` (
  `id_banner` int NOT NULL,
  `location_banner` text,
  `id_category_banner` int NOT NULL DEFAULT '0',
  `id_subcategory_banner` int NOT NULL DEFAULT '0',
  `background_banner` text,
  `text_banner` text,
  `discount_banner` text,
  `end_banner` date DEFAULT NULL,
  `status_banner` int NOT NULL DEFAULT '1',
  `date_created_banner` date DEFAULT NULL,
  `date_updated_banner` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `banners`
--

INSERT INTO `banners` (`id_banner`, `location_banner`, `id_category_banner`, `id_subcategory_banner`, `background_banner`, `text_banner`, `discount_banner`, `end_banner`, `status_banner`, `date_created_banner`, `date_updated_banner`) VALUES
(1, 'HOME', 0, 0, 'default.jpg', 'Ofertas especiales', '50', '2030-04-30', 1, '2024-05-22', '2024-05-22 21:24:48'),
(3, 'CATEGORÍA', 1, 0, 'bg.jpg', 'Descuentos Especiales', '50', '2030-12-31', 1, '2024-05-22', '2024-05-22 21:28:53'),
(4, 'CATEGORÍA', 5, 0, 'bg.jpg', 'Ofertas de Cursos', '50', '2029-12-20', 1, '2024-05-22', '2024-05-22 21:30:00'),
(5, 'SUBCATEGORÍA', 0, 6, 'bg.jpg', 'Ofertas en Calzado Hombre', '30', '2028-11-22', 1, '2024-05-22', '2024-05-22 21:38:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carts`
--

CREATE TABLE `carts` (
  `id_cart` int NOT NULL,
  `id_user_cart` int NOT NULL DEFAULT '0',
  `id_product_cart` int NOT NULL DEFAULT '0',
  `id_variant_cart` int NOT NULL DEFAULT '0',
  `quantity_cart` int DEFAULT '0',
  `price_cart` double NOT NULL DEFAULT '0',
  `ref_cart` text,
  `order_cart` text,
  `method_cart` text,
  `date_created_cart` date DEFAULT NULL,
  `date_updated_cart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id_category` int NOT NULL,
  `name_category` text,
  `url_category` text,
  `icon_category` text,
  `image_category` text,
  `description_category` text,
  `keywords_category` text,
  `subcategories_category` int DEFAULT '0',
  `products_category` int DEFAULT '0',
  `views_category` int DEFAULT '0',
  `status_category` int DEFAULT '1',
  `date_created_category` date DEFAULT NULL,
  `date_updated_category` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id_category`, `name_category`, `url_category`, `icon_category`, `image_category`, `description_category`, `keywords_category`, `subcategories_category`, `products_category`, `views_category`, `status_category`, `date_created_category`, `date_updated_category`) VALUES
(1, 'Ropa', 'ropa', 'fas fa-tshirt', 'ropa.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tincidunt velit a ullamcorper eleifend. Aenean aliquam, odio et laoreet ultricies, dolor nibh dignissim sapien, ac lacinia quam ligula et massa.', 'ropa,camisas,pantalones,blusas,faldas', 4, 18, 0, 1, '2023-06-29', '2023-09-05 14:09:08'),
(2, 'Calzado', 'calzado', 'fas fa-shoe-prints', 'calzado.jpg', 'Duis dolor ex, condimentum in purus in, sodales convallis velit. Sed malesuada non ligula lobortis porta. Etiam aliquam tincidunt justo, id aliquet metus hendrerit nec. In congue leo risus, vel varius sapien porta in. Aenean efficitur', 'calzado,tennis,chanclas,sandalias', 4, 2, 0, 1, '2023-06-29', '2023-08-10 23:41:52'),
(3, 'Tecnología', 'tecnologia', 'fas fa-laptop', 'tecnologia.jpg', 'urabitur nibh libero, aliquet scelerisque tellus non, pulvinar mollis erat. Donec ac vehicula dolor. Nulla lobortis nisi at dapibus imperdiet. In ornare ante viverra quam efficitur efficitur. Sed felis sem, rutrum nec iaculis eget,', 'pc,portatil,ordenador,servidor', 4, 0, 0, 1, '2023-06-29', '2023-07-05 18:18:33'),
(5, 'Cursos', 'cursos', 'fas fa-graduation-cap', 'cursos.jpg', 'Nunc erat est, suscipit eu vulputate id, venenatis volutpat nulla. Proin et mauris et odio faucibus laoreet quis viverra massa. Suspendisse potenti.', 'cursos,tutorías,tutoriales,virtualidad', 4, 6, 0, 1, '2023-06-30', '2023-08-05 15:15:01'),
(6, 'Accesorios', 'accesorios', 'fas fa-anchor', 'accesorios.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tincidunt velit a ullamcorper eleifend. Aenean aliquam, odio et laoreet ultricies, dolor nibh dignissim sapien, ac lacinia quam ligula et massa.', 'accesorios,lorem,ipsum', 1, 4, 0, 1, '2023-08-08', '2023-08-08 21:27:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorites`
--

CREATE TABLE `favorites` (
  `id_favorite` int NOT NULL,
  `id_user_favorite` int NOT NULL DEFAULT '0',
  `id_product_favorite` int NOT NULL DEFAULT '0',
  `date_created_favorite` date DEFAULT NULL,
  `date_updated_favorite` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `favorites`
--

INSERT INTO `favorites` (`id_favorite`, `id_user_favorite`, `id_product_favorite`, `date_created_favorite`, `date_updated_favorite`) VALUES
(10, 4, 21, '2024-01-25', '2024-01-25 17:58:52'),
(12, 4, 40, '2024-01-25', '2024-01-25 18:01:10'),
(13, 4, 21, '2024-01-25', '2024-01-25 19:44:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id_order` int NOT NULL,
  `uniqid_order` text,
  `id_user_order` int NOT NULL DEFAULT '0',
  `id_product_order` int NOT NULL DEFAULT '0',
  `id_variant_order` int NOT NULL DEFAULT '0',
  `quantity_order` int NOT NULL DEFAULT '0',
  `price_order` double NOT NULL DEFAULT '0',
  `ref_order` text,
  `number_order` text,
  `method_order` text,
  `warranty_order` int NOT NULL DEFAULT '0',
  `process_order` int NOT NULL DEFAULT '0',
  `track_order` text,
  `start_date_order` date DEFAULT NULL,
  `medium_date_order` date DEFAULT NULL,
  `end_date_order` date DEFAULT NULL,
  `date_created_order` date DEFAULT NULL,
  `date_updated_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id_order`, `uniqid_order`, `id_user_order`, `id_product_order`, `id_variant_order`, `quantity_order`, `price_order`, `ref_order`, `number_order`, `method_order`, `warranty_order`, `process_order`, `track_order`, `start_date_order`, `medium_date_order`, `end_date_order`, `date_created_order`, `date_updated_order`) VALUES
(1, '664fa12bef541', 4, 21, 50, 3, 450, '86291706914879', 'DP-41467', 'dlocal', 7, 2, '24124124', '2024-02-02', '2024-05-01', '2024-05-23', '2024-02-02', '2024-05-23 20:05:36'),
(2, '664fa1938e116', 4, 20, 48, 1, 150, '86291706914879', 'DP-41467', 'dlocal', 7, 2, '24124124', '2024-02-02', '2024-02-03', '2024-02-05', '2024-02-02', '2024-05-23 20:05:47'),
(3, '664fa19e55324', 4, 42, 76, 1, 19, '86291706914879', 'DP-41467', 'dlocal', 7, 2, NULL, '2024-05-23', NULL, NULL, '2024-02-02', '2024-05-23 20:05:57'),
(4, '664fa2123da8d', 5, 20, 48, 1, 150, '45071707152340', '36U83700DE932372L', 'paypal', 7, 1, '21241251236', '2024-02-05', '2024-05-23', '2024-05-27', '2024-02-05', '2024-05-23 20:07:53'),
(5, '664fa21b9a9aa', 5, 41, 75, 1, 19, '76861707161833', '4U751830NX757045H', 'paypal', 7, 2, NULL, '2024-02-05', NULL, NULL, '2024-02-05', '2024-05-23 20:08:02'),
(6, '664fa2259fbf3', 5, 39, 73, 1, 19, '22851707161999', '4EH513729J348331A', 'paypal', 7, 2, NULL, '2024-02-05', NULL, NULL, '2024-02-05', '2024-05-23 20:08:12'),
(7, '664fa22f822e5', 4, 17, 41, 2, 300, '65631712934911', '97W699981W093833Y', 'paypal', 7, 0, NULL, '2024-04-12', NULL, NULL, '2024-04-12', '2024-05-23 20:08:22'),
(8, '664fa2385c534', 4, 22, 52, 2, 300, '65631712934911', '97W699981W093833Y', 'paypal', 7, 0, NULL, '2024-04-12', NULL, NULL, '2024-04-12', '2024-05-23 20:08:30'),
(9, '664fa2412a85f', 4, 42, 76, 1, 19, '65631712934911', '97W699981W093833Y', 'paypal', 7, 2, NULL, '2024-04-12', NULL, NULL, '2024-04-12', '2024-05-23 20:08:39'),
(10, '6654e3c962f17', 4, 18, 45, 1, 300, '12801716839143', '19G74859EU5691709', 'paypal', 7, 0, NULL, '2024-05-27', NULL, NULL, '2024-05-27', '2024-05-27 19:49:29'),
(11, '6654e3c98afad', 4, 18, 44, 1, 300, '12801716839143', '19G74859EU5691709', 'paypal', 7, 0, NULL, '2024-05-27', NULL, NULL, '2024-05-27', '2024-05-27 19:49:29'),
(12, '6654e4aa6a09b', 4, 21, 49, 1, 150, '14391716839510', 'DP-54074', 'dlocal', 7, 0, NULL, '2024-05-27', NULL, NULL, '2024-05-27', '2024-05-27 19:53:14'),
(16, '66550190eb01c', 4, 41, 75, 1, 38, '71691716846933', '', 'mercado_pago', 7, 2, NULL, '2024-05-27', NULL, NULL, '2024-05-27', '2024-05-27 21:56:33'),
(17, '6655019114271', 4, 39, 73, 1, 38, '71691716846933', '', 'mercado_pago', 7, 2, NULL, '2024-05-27', NULL, NULL, '2024-05-27', '2024-05-27 21:56:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_product` int NOT NULL,
  `id_category_product` int NOT NULL DEFAULT '0',
  `id_subcategory_product` int NOT NULL DEFAULT '0',
  `name_product` text,
  `url_product` text,
  `image_product` text,
  `description_product` text,
  `keywords_product` text,
  `info_product` longtext,
  `views_product` int NOT NULL DEFAULT '0',
  `sales_product` int NOT NULL DEFAULT '0',
  `status_product` int NOT NULL DEFAULT '1',
  `date_created_product` date DEFAULT NULL,
  `date_updated_product` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `id_category_product`, `id_subcategory_product`, `name_product`, `url_product`, `image_product`, `description_product`, `keywords_product`, `info_product`, `views_product`, `sales_product`, `status_product`, `date_created_product`, `date_updated_product`) VALUES
(1, 1, 1, 'Conjunto 1 Ropa Dama 1', 'conjunto-1-ropa-dama-1', 'conjunto-1-ropa-dama-1.jpg', 'Morbi eu risus nisi. Mauris nisl augue, pellentesque id arcu ut, commodo volutpat nisl. Vivamus consectetur justo sit amet lectus fermentum accumsan. Curabitur ac orci nisl.', 'ropa,dama,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-1-ropa-dama-1/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\n							            </p>', 7, 0, 1, '2023-07-03', '2024-05-27 22:56:54'),
(4, 1, 1, 'Conjunto 2 Ropa Dama 1', 'conjunto-2-ropa-dama-1', 'conjunto-2-ropa-dama-1.jpg', 'Morbi eu risus nisi. Mauris nisl augue, pellentesque id arcu ut, commodo volutpat nisl. Vivamus consectetur justo sit amet lectus fermentum accumsan. Curabitur ac orci nisl.', 'ropa,dama,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-2-ropa-dama-1/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 0, 0, 1, '2023-07-03', '2023-07-27 18:46:55'),
(5, 1, 1, 'Conjunto 3 Ropa Dama 1', 'conjunto-3-ropa-dama-1', 'conjunto-3-ropa-dama-1.jpg', 'Morbi eu risus nisi. Mauris nisl augue, pellentesque id arcu ut, commodo volutpat nisl. Vivamus consectetur justo sit amet lectus fermentum accumsan. Curabitur ac orci nisl.', 'ropa,dama,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-3-ropa-dama-1/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 0, 0, 1, '2023-07-03', '2023-07-27 18:46:55'),
(6, 1, 2, 'Conjunto 1 Ropa Hombre 1', 'conjunto-1-ropa-hombre-1', 'conjunto-1-ropa-hombre-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'ropa,hombre,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-1-ropa-hombre-1/4865831814.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 1, 0, 1, '2023-08-03', '2024-05-27 23:10:21'),
(7, 1, 2, 'Conjunto 2 Ropa Hombre 1', 'conjunto-2-ropa-hombre-1', 'conjunto-2-ropa-hombre-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'ropa,hombre,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-2-ropa-hombre-1/4865831814.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 9, 0, 1, '2023-08-03', '2024-05-28 00:57:15'),
(8, 1, 3, 'Conjunto Deportivo 1', 'conjunto-deportivo-1', 'conjunto-deportivo-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'ropa,deportiva,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_2.png\') -500px -100px no-repeat;background-size:825px 175px;\" alt=\":football:\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.<img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_2.png\') -750px -100px no-repeat;background-size:825px 175px;\" alt=\":bicyclist:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-deportivo-1/1758272835.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.<br></p><p>							            				\r\n							            </p>', 0, 0, 1, '2023-08-03', '2023-08-03 17:14:11'),
(9, 1, 1, 'Conjunto 1 Ropa Dama 2', 'conjunto-1-ropa-dama-2', 'conjunto-1-ropa-dama-2.jpg', 'Morbi eu risus nisi. Mauris nisl augue, pellentesque id arcu ut, commodo volutpat nisl. Vivamus consectetur justo sit amet lectus fermentum accumsan. Curabitur ac orci nisl.', 'ropa,dama,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-1-ropa-dama-2/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 0, 0, 1, '2023-07-03', '2023-08-03 17:09:13'),
(10, 1, 1, 'Conjunto 2 Ropa Dama 2', 'conjunto-2-ropa-dama-2', 'conjunto-2-ropa-dama-2.jpg', 'Morbi eu risus nisi. Mauris nisl augue, pellentesque id arcu ut, commodo volutpat nisl. Vivamus consectetur justo sit amet lectus fermentum accumsan. Curabitur ac orci nisl.', 'ropa,dama,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-2-ropa-dama-2/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 0, 0, 1, '2023-07-03', '2023-08-03 17:09:13'),
(11, 1, 1, 'Conjunto 3 Ropa Dama 2', 'conjunto-3-ropa-dama-2', 'conjunto-3-ropa-dama-2.jpg', 'Morbi eu risus nisi. Mauris nisl augue, pellentesque id arcu ut, commodo volutpat nisl. Vivamus consectetur justo sit amet lectus fermentum accumsan. Curabitur ac orci nisl.', 'ropa,dama,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-3-ropa-dama-2/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 3, 0, 1, '2023-07-03', '2023-08-10 23:24:42'),
(12, 1, 2, 'Conjunto 1 Ropa Hombre 2', 'conjunto-1-ropa-hombre-2', 'conjunto-1-ropa-hombre-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'ropa,hombre,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-1-ropa-hombre-2/4865831814.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 1, 0, 1, '2023-08-03', '2024-05-27 23:24:34'),
(13, 1, 2, 'Conjunto 2 Ropa Hombre 2', 'conjunto-2-ropa-hombre-2', 'conjunto-2-ropa-hombre-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'ropa,hombre,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-2-ropa-hombre-2/4865831814.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 1, 0, 1, '2023-08-03', '2024-05-27 23:53:12'),
(14, 1, 3, 'Conjunto Deportivo 2', 'conjunto-deportivo-2', 'conjunto-deportivo-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'ropa,deportiva,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_2.png\') -500px -100px no-repeat;background-size:825px 175px;\" alt=\":football:\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.<img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_2.png\') -750px -100px no-repeat;background-size:825px 175px;\" alt=\":bicyclist:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-deportivo-2/1758272835.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.<br></p><p>							            				\r\n							            </p>', 0, 0, 1, '2023-08-03', '2023-08-03 17:14:11'),
(15, 1, 1, 'Conjunto 1 Ropa Dama 3', 'conjunto-1-ropa-dama-3', 'conjunto-1-ropa-dama-3.jpg', 'Morbi eu risus nisi. Mauris nisl augue, pellentesque id arcu ut, commodo volutpat nisl. Vivamus consectetur justo sit amet lectus fermentum accumsan. Curabitur ac orci nisl.', 'ropa,dama,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-1-ropa-dama-3/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 0, 0, 1, '2023-07-03', '2023-08-03 17:09:13'),
(16, 1, 1, 'Conjunto 2 Ropa Dama 3', 'conjunto-2-ropa-dama-3', 'conjunto-2-ropa-dama-3.jpg', 'Morbi eu risus nisi. Mauris nisl augue, pellentesque id arcu ut, commodo volutpat nisl. Vivamus consectetur justo sit amet lectus fermentum accumsan. Curabitur ac orci nisl.', 'ropa,dama,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-2-ropa-dama-3/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 0, 0, 1, '2023-07-03', '2023-08-03 17:09:13'),
(17, 1, 1, 'Conjunto 3 Ropa Dama 3', 'conjunto-3-ropa-dama-3', 'conjunto-3-ropa-dama-3.jpg', 'Morbi eu risus nisi. Mauris nisl augue, pellentesque id arcu ut, commodo volutpat nisl. Vivamus consectetur justo sit amet lectus fermentum accumsan. Curabitur ac orci nisl.', 'ropa,dama,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-3-ropa-dama-3/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 0, 0, 1, '2023-07-03', '2023-08-03 17:09:13'),
(18, 1, 2, 'Conjunto 1 Ropa Hombre 3', 'conjunto-1-ropa-hombre-3', 'conjunto-1-ropa-hombre-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'ropa,hombre,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-1-ropa-hombre-3/4865831814.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 1, 0, 1, '2023-08-03', '2024-05-27 23:39:07'),
(19, 1, 2, 'Conjunto 2 Ropa Hombre 3', 'conjunto-2-ropa-hombre-3', 'conjunto-2-ropa-hombre-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'ropa,hombre,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-2-ropa-hombre-3/4865831814.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 1, 0, 1, '2023-08-03', '2024-05-28 00:07:28'),
(20, 1, 3, 'Conjunto Deportivo 3', 'conjunto-deportivo-3', 'conjunto-deportivo-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'ropa,deportiva,lorem,ipsum', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_2.png\') -500px -100px no-repeat;background-size:825px 175px;\" alt=\":football:\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.<img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_2.png\') -750px -100px no-repeat;background-size:825px 175px;\" alt=\":bicyclist:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-deportivo-3/1758272835.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.<br></p><p>							            				\r\n							            </p>', 16, 0, 1, '2023-08-03', '2024-05-28 08:37:50'),
(21, 2, 7, 'Tennis Deportivo 1', 'tennis-deportivo-1', 'tennis-deportivo-1.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'tennis,calzado,deportivo', '<div><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_2.png\') -500px -100px no-repeat;background-size:825px 175px;\" alt=\":football:\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.<img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_2.png\') -450px 0px no-repeat;background-size:825px 175px;\" alt=\":balloon:\"></div><div><br></div><div><img style=\"width: 100%;\" src=\"/views/assets/img/products/tennis-deportivo-1/7313634339.png\" class=\"img-fluid\"><br></div><div><br></div><div>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</div>', 23, 0, 1, '2023-08-03', '2024-05-28 08:37:49');
INSERT INTO `products` (`id_product`, `id_category_product`, `id_subcategory_product`, `name_product`, `url_product`, `image_product`, `description_product`, `keywords_product`, `info_product`, `views_product`, `sales_product`, `status_product`, `date_created_product`, `date_updated_product`) VALUES
(22, 2, 7, 'Tennis Deportivo 2', 'tennis-deportivo-2', 'tennis-deportivo-2.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'tennis,calzado,deportivo', '<div><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_2.png\') -500px -100px no-repeat;background-size:825px 175px;\" alt=\":football:\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.<img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_2.png\') -450px 0px no-repeat;background-size:825px 175px;\" alt=\":balloon:\"></div><div><br></div><div><img style=\"width: 100%;\" src=\"/views/assets/img/products/tennis-deportivo-2/7313634339.png\" class=\"img-fluid\"><br></div><div><br></div><div>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</div>', 0, 0, 1, '2023-08-03', '2023-08-03 18:04:23'),
(23, 2, 7, 'Tennis Deportivo 3', 'tennis-deportivo-3', 'tennis-deportivo-3.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'tennis,calzado,deportivo', '<div><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_2.png\') -500px -100px no-repeat;background-size:825px 175px;\" alt=\":football:\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.<img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_2.png\') -450px 0px no-repeat;background-size:825px 175px;\" alt=\":balloon:\"></div><div><br></div><div><img style=\"width: 100%;\" src=\"/views/assets/img/products/tennis-deportivo-3/7313634339.png\" class=\"img-fluid\"><br></div><div><br></div><div>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</div>', 0, 0, 1, '2023-08-03', '2023-08-03 18:04:23'),
(24, 2, 6, 'Calzado Masculino', 'calzado-masculino', 'calzado-masculino.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'calzado,masculino,lorem', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</div><div><br></div><div><img style=\"width: 100%;\" src=\"/views/assets/img/products/calzado-masculino/3053216752.jpg\" class=\"img-fluid\"><br></div><div><br></div><div>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</div>', 0, 0, 1, '2023-08-03', '2023-08-03 18:10:12'),
(25, 5, 13, 'Curso De Css 1', 'curso-de-css-1', 'curso-de-css-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'cursos,css ,html', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-css-1/6597015822.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</p><p>							            				\r\n							            </p>', 0, 0, 1, '2023-08-05', '2023-08-10 23:36:47'),
(26, 5, 13, 'Curso De Bootstrap 1', 'curso-de-bootstrap-1', 'curso-de-bootstrap-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'cursos,bootstrap,html,css', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</div><div><br></div><div><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-bootstrap-1/2576051612.jpg\" class=\"img-fluid\"><br></div><div><br></div><div>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</div><div><br></div>', 1, 0, 1, '2023-08-05', '2024-05-28 08:02:40'),
(27, 5, 13, 'Curso De Javascript 1', 'curso-de-javascript-1', 'curso-de-javascript-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'curso,javascript,desarrollo web', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-javascript-1/2905973340.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</p><p>							            				\r\n							            </p>', 0, 0, 1, '2023-08-05', '2023-08-05 15:08:09'),
(28, 5, 13, 'Curso De Jquery 1', 'curso-de-jquery-1', 'curso-de-jquery-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'curso,web,jquery', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</div><div><br></div><div><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-jquery-1/3791538342.jpg\" class=\"img-fluid\"><br></div><div><br></div><div>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</div><div><br></div>', 0, 0, 1, '2023-08-05', '2023-08-05 15:10:44'),
(29, 5, 13, 'Curso De Canvas 1', 'curso-de-canvas-1', 'curso-de-canvas-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'canvas,cursos,desarrollo web', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-canvas-1/1170252210.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</p><p>							            				\r\n							            </p>', 0, 0, 1, '2023-08-05', '2023-08-05 15:12:44'),
(30, 5, 13, 'Curso De Php 1', 'curso-de-php-1', 'curso-de-php-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'cursos ,php ,backend', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-php-1/4106364930.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.<br></p><p>							            				\r\n							            </p>', 0, 0, 1, '2023-08-05', '2023-08-05 15:15:01'),
(31, 5, 13, 'Curso De Css 2', 'curso-de-css-2', 'curso-de-css-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'cursos,css ,html', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-css-2/6597015822.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</p><p>							            				\r\n							            </p>', 0, 0, 1, '2023-08-05', '2023-08-05 14:59:06'),
(32, 5, 13, 'Curso De Bootstrap 2', 'curso-de-bootstrap-2', 'curso-de-bootstrap-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'cursos,bootstrap,html,css', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</div><div><br></div><div><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-bootstrap-2/2576051612.jpg\" class=\"img-fluid\"><br></div><div><br></div><div>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</div><div><br></div>', 0, 0, 1, '2023-08-05', '2023-08-05 15:02:55'),
(33, 5, 13, 'Curso De Javascript 2', 'curso-de-javascript-2', 'curso-de-javascript-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'curso,javascript,desarrollo web', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-javascript-2/2905973340.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</p><p>							            				\r\n							            </p>', 1, 0, 1, '2023-08-05', '2024-05-28 01:14:02'),
(34, 5, 13, 'Curso De Jquery 2', 'curso-de-jquery-2', 'curso-de-jquery-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'curso,web,jquery', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</div><div><br></div><div><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-jquery-2/3791538342.jpg\" class=\"img-fluid\"><br></div><div><br></div><div>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</div><div><br></div>', 0, 0, 1, '2023-08-05', '2023-08-05 15:10:44'),
(35, 5, 13, 'Curso De Canvas 2', 'curso-de-canvas-2', 'curso-de-canvas-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'canvas,cursos,desarrollo web', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-canvas-2/1170252210.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</p><p>							            				\r\n							            </p>', 0, 0, 1, '2023-08-05', '2023-08-05 15:12:44'),
(36, 5, 13, 'Curso De Php 2', 'curso-de-php-2', 'curso-de-php-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'cursos ,php ,backend', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-php-2/4106364930.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.<br></p><p>							            				\r\n							            </p>', 0, 0, 1, '2023-08-05', '2023-08-05 15:15:01'),
(37, 5, 13, 'Curso De Css 3', 'curso-de-css-3', 'curso-de-css-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'cursos,css ,html', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-css-3/6597015822.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</p><p>							            				\r\n							            </p>', 2, 45, 1, '2023-08-05', '2024-05-28 08:37:50'),
(38, 5, 13, 'Curso De Bootstrap 3', 'curso-de-bootstrap-3', 'curso-de-bootstrap-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'cursos,bootstrap,html,css', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</div><div><br></div><div><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-bootstrap-3/2576051612.jpg\" class=\"img-fluid\"><br></div><div><br></div><div>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</div><div><br></div>', 0, 7, 1, '2023-08-05', '2023-08-11 00:10:50'),
(39, 5, 13, 'Curso De Javascript 3', 'curso-de-javascript-3', 'curso-de-javascript-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'curso,javascript,desarrollo web', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-javascript-3/2905973340.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</p><p>							            				\r\n							            </p>', 0, 11, 1, '2023-08-05', '2023-08-11 00:10:47'),
(40, 5, 13, 'Curso De Jquery 3', 'curso-de-jquery-3', 'curso-de-jquery-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'curso,web,jquery', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</div><div><br></div><div><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-jquery-3/3791538342.jpg\" class=\"img-fluid\"><br></div><div><br></div><div>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</div><div><br></div>', 0, 22, 1, '2023-08-05', '2023-08-11 00:10:44'),
(41, 5, 13, 'Curso De Canvas 3', 'curso-de-canvas-3', 'curso-de-canvas-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'canvas,cursos,desarrollo web', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-canvas-3/1170252210.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.</p><p>							            				\r\n							            </p>', 1, 33, 1, '2023-08-05', '2024-05-28 08:37:49'),
(42, 5, 13, 'Curso De Php 3', 'curso-de-php-3', 'curso-de-php-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.', 'cursos ,php ,backend', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper feugiat enim vitae aliquet. Nunc quis commodo libero. Etiam non pellentesque mi, quis ultricies velit. Nulla ultrices congue odio accumsan pellentesque.</p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/curso-de-php-3/4106364930.jpg\" class=\"img-fluid\"><br></p><p>Sed mi tortor, venenatis eget ante sed, dignissim blandit lectus. Etiam rhoncus nibh at velit elementum posuere. Donec semper scelerisque lectus, nec ornare ipsum fermentum non.<br></p><p>							            				\r\n							            </p>', 1, 55, 1, '2023-08-05', '2024-05-28 08:37:44'),
(43, 6, 17, 'Accesorio 1', 'accesorio-1', 'accesorio-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tincidunt velit a ullamcorper eleifend. Aenean aliquam, odio et laoreet ultricies, dolor nibh dignissim sapien, ac lacinia quam ligula et massa.', 'accesorio,joyas,lorem', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-1-ropa-dama-1/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 0, 0, 1, '2023-08-08', '2023-08-08 21:24:55'),
(44, 6, 17, 'Accesorio 2', 'accesorio-2', 'accesorio-2.jpg', 'Morbi eu risus nisi. Mauris nisl augue, pellentesque id arcu ut, commodo volutpat nisl. Vivamus consectetur justo sit amet lectus fermentum accumsan. Curabitur ac orci nisl.', 'accesorio,maleta', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-1-ropa-dama-1/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 1, 0, 1, '2023-08-08', '2024-05-28 01:10:50'),
(45, 6, 17, 'Accesorio 3', 'accesorio-3', 'accesorio-3.jpg', 'Morbi eu risus nisi. Mauris nisl augue, pellentesque id arcu ut, commodo volutpat nisl. Vivamus consectetur justo sit amet lectus fermentum accumsan. Curabitur ac orci nisl.', 'accesorio,maleta', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-1-ropa-dama-1/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 1, 0, 1, '2023-08-08', '2024-05-28 08:37:45'),
(46, 6, 17, 'Accesorio 4', 'accesorio-4', 'accesorio-4.jpg', 'Morbi eu risus nisi. Mauris nisl augue, pellentesque id arcu ut, commodo volutpat nisl. Vivamus consectetur justo sit amet lectus fermentum accumsan. Curabitur ac orci nisl.', 'accesorio,anillo', '<p><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -250px -150px no-repeat;background-size:675px 175px;\" alt=\":heart:\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget aliquam urna, eu pharetra nisi. Maecenas lacinia tristique tincidunt. Aliquam in auctor metus. Pellentesque neque ante, rutrum ut est at, lacinia aliquet neque. Donec vitae ex orci.</span><img src=\"/views/assets/css/plugins/summernote/img/blank.gif\" class=\"img\" style=\"display:inline-block;width:25px;height:25px;background:url(\'/views/assets/css/plugins/summernote/img/emoji_spritesheet_0.png\') -75px -75px no-repeat;background-size:675px 175px;\" alt=\":see_no_evil:\"></p><p><img style=\"width: 100%;\" src=\"/views/assets/img/products/conjunto-1-ropa-dama-1/6546023218.jpg\" class=\"img-fluid\"><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"> Duis vehicula vehicula lacus, vel congue eros ultrices vel. Nam posuere elit ut ligula venenatis volutpat. Nullam ac lectus vel felis pretium auctor a ac massa. </span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><b>Fusce in fringilla ante. Vestibulum auctor accumsan dui, non pharetra urna gravida id. Sed in felis et urna posuere egestas vel feugiat eros. </b></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Nunc malesuada, nibh id venenatis eleifend, mi augue rutrum purus, dignissim luctus justo lorem non risus. Nulla iaculis metus non justo consequat, ac placerat arcu fringilla. Praesent nec consectetur nunc. Aenean sollicitudin, diam vel mollis semper, est est tincidunt ligula, et accumsan mi risus quis erat. Nulla sagittis ex a consectetur mollis.</span>							            							            								            				\r\n							            </p>', 1, 0, 1, '2023-08-08', '2024-05-28 08:53:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slides`
--

CREATE TABLE `slides` (
  `id_slide` int NOT NULL,
  `background_slide` text,
  `direction_slide` text,
  `img_png_slide` text,
  `coord_img_slide` text,
  `text_slide` text,
  `coord_text_slide` text,
  `link_slide` text,
  `text_btn_slide` text,
  `status_slide` int NOT NULL DEFAULT '1',
  `date_created_slide` date DEFAULT NULL,
  `date_updated_slide` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `slides`
--

INSERT INTO `slides` (`id_slide`, `background_slide`, `direction_slide`, `img_png_slide`, `coord_img_slide`, `text_slide`, `coord_text_slide`, `link_slide`, `text_btn_slide`, `status_slide`, `date_created_slide`, `date_updated_slide`) VALUES
(1, 'back_default.jpg', 'opt1', 'calzado.png', 'top:15%; right:10%; width:45%', '[{\"text\":\"Lorem Ipsum\",\"color\":\"#333\"},{\"text\":\"Lorem ipsum dolor sit\",\"color\":\"#777\"},{\"text\":\"Lorem ipsum dolor sit\",\"color\":\"#888\"}]', 'top:20%; left:10%; width:40%', 'http://ecommerce.com/calzado', 'VER PRODUCTO', 1, '2024-05-22', '2024-05-22 19:00:50'),
(2, 'fondo2.jpg', 'opt2', 'iphone.png', 'bottom:0%; left:15%; width:28%', '[{\"text\":\"Lorem Ipsum\",\"color\":\"#ffffff\"},{\"text\":\"Lorem ipsum dolor sit\",\"color\":\"#e8e8e8\"},{\"text\":\"Lorem ipsum dolor sit\",\"color\":\"#d6d6d6\"}]', 'top:20%; right:15%; width:40%', 'http://ecommerce.com/no-found', 'VER PRODUCTO', 1, '2024-05-22', '2024-05-22 19:00:49'),
(4, 'bg.jpg', '', '', '', '', '', '', '', 1, '2024-05-22', '2024-05-22 19:00:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socials`
--

CREATE TABLE `socials` (
  `id_social` int NOT NULL,
  `name_social` text,
  `url_social` text,
  `icon_social` text,
  `color_social` text,
  `date_created_social` date DEFAULT NULL,
  `date_updated_social` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `socials`
--

INSERT INTO `socials` (`id_social`, `name_social`, `url_social`, `icon_social`, `color_social`, `date_created_social`, `date_updated_social`) VALUES
(1, 'facebook', 'https://facebook.com', 'fab fa-facebook-f', 'text-white', '2022-09-24', '2024-05-20 22:22:38'),
(2, 'youtube', 'https://youtube.com', 'fab fa-youtube', 'text-white', '2022-09-24', '2022-09-24 18:20:47'),
(3, 'twitter', 'https://twitter.com', 'fab fa-twitter', 'text-white', '2022-09-24', '2022-09-24 18:20:51'),
(4, 'instagram', 'https://instagram.com', 'fab fa-instagram', 'text-white', '2022-09-24', '2022-09-24 18:20:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategories`
--

CREATE TABLE `subcategories` (
  `id_subcategory` int NOT NULL,
  `id_category_subcategory` int NOT NULL DEFAULT '0',
  `name_subcategory` text,
  `url_subcategory` text,
  `image_subcategory` text,
  `description_subcategory` text,
  `keywords_subcategory` text,
  `products_subcategory` int NOT NULL DEFAULT '0',
  `views_subcategory` int NOT NULL DEFAULT '0',
  `status_subcategory` int NOT NULL DEFAULT '1',
  `date_created_subcategory` date DEFAULT NULL,
  `date_updated_subcategory` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `subcategories`
--

INSERT INTO `subcategories` (`id_subcategory`, `id_category_subcategory`, `name_subcategory`, `url_subcategory`, `image_subcategory`, `description_subcategory`, `keywords_subcategory`, `products_subcategory`, `views_subcategory`, `status_subcategory`, `date_created_subcategory`, `date_updated_subcategory`) VALUES
(1, 1, 'Ropa Para Dama', 'ropa-para-dama', 'ropa-para-dama.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut cum quae laboriosam asperiores dolorem iure id provident voluptates ipsum magni ea ipsam tempore, aut, expedita at maxime autem consequuntur distinctio!', 'ropa,lorem,ipsum', 0, 0, 1, '2023-03-04', '2023-08-03 16:57:50'),
(2, 1, 'Ropa Para Hombre', 'ropa-para-hombre', 'ropa-para-hombre.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'ropa,lorem,ipsum', 1, 0, 1, '2023-03-08', '2023-08-05 15:38:56'),
(3, 1, 'Ropa Deportiva', 'ropa-deportiva', 'ropa-deportiva.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'ropa,lorem,ipsum', 1, 0, 1, '2023-03-08', '2023-08-03 17:14:11'),
(4, 1, 'Ropa Infantil', 'ropa-infantil', 'ropa-infantil.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'ropa,lorem,ipsum', 0, 0, 1, '2023-03-08', '2023-07-02 16:50:01'),
(5, 2, 'Calzado Para Dama', 'calzado-para-dama', 'calzado-para-dama.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'calzado,lorem,ipsum', 0, 0, 1, '2023-03-08', '2023-07-05 20:01:23'),
(6, 2, 'Calzado Para Hombre', 'calzado-para-hombre', 'calzado-para-hombre.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'calzado,lorem,ipsum', 1, 0, 1, '2023-03-08', '2023-08-03 18:10:12'),
(7, 2, 'Calzado Deportivo', 'calzado-deportivo', 'calzado-deportivo.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'calzado,lorem,ipsum', 1, 0, 1, '2023-03-08', '2023-08-10 23:41:52'),
(8, 2, 'Calzado Infantil', 'calzado-infantil', 'calzado-infantil.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'calzado,lorem,ipsum', 0, 0, 1, '2023-03-08', '2023-07-02 16:56:43'),
(9, 3, 'Teléfonos Móvil', 'telefonos-movil', 'telefonos-movil.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'tecnologia,lorem,ipsum', 0, 0, 1, '2023-03-08', '2023-07-02 16:50:24'),
(10, 3, 'Tabletas Electrónicas', 'tabletas-electronicas', 'tabletas-electronicas.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'tecnologia,lorem,ipsum', 0, 0, 1, '2023-03-08', '2023-07-02 16:50:27'),
(11, 3, 'Computadoras', 'computadoras', 'computadoras.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'tecnologia,lorem,ipsum', 0, 0, 1, '2023-03-08', '2023-07-02 16:50:29'),
(12, 3, 'Auriculares', 'auriculares', 'auriculares.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'tecnologia,lorem,ipsum', 0, 0, 1, '2023-03-08', '2023-07-02 16:50:31'),
(13, 5, 'Desarrollo Web', 'desarrollo-web', 'desarrollo-web.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'cursos,lorem,ipsum', 6, 0, 1, '2023-03-08', '2023-08-05 15:15:02'),
(14, 5, 'Aplicaciones Móviles', 'aplicaciones-moviles', 'aplicaciones-moviles.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'cursos,lorem,ipsum', 0, 0, 1, '2023-03-08', '2023-07-02 16:54:11'),
(15, 5, 'Diseño Gráfico', 'diseno-grafico', 'diseno-grafico.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'cursos,lorem,ipsum', 0, 0, 1, '2023-03-08', '2023-07-02 16:54:13'),
(16, 5, 'Marketing Digital', 'marketing-digital', 'marketing-digital.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Corporis aspernatur temporibus vero sit error, consectetur, dignissimos excepturi enim? Facilis dolor blanditiis molestiae dolores fugiat alias fugit reprehenderit soluta earum ducimus', 'cursos,lorem,ipsum', 0, 0, 1, '2023-03-08', '2023-07-02 16:54:15'),
(17, 6, 'Variedades', 'variedades', 'variedades.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tincidunt velit a ullamcorper eleifend. Aenean aliquam, odio et laoreet ultricies, dolor nibh dignissim sapien, ac lacinia quam ligula et massa.', 'variedades,accesorios,lorem,ipsum', 4, 0, 1, '2023-08-08', '2023-08-08 21:27:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `templates`
--

CREATE TABLE `templates` (
  `id_template` int NOT NULL,
  `logo_template` text,
  `icon_template` text,
  `cover_template` text,
  `title_template` text,
  `description_template` text,
  `keywords_template` text,
  `fonts_template` text,
  `colors_template` text,
  `active_template` text,
  `date_created_template` date DEFAULT NULL,
  `date_updated_template` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `templates`
--

INSERT INTO `templates` (`id_template`, `logo_template`, `icon_template`, `cover_template`, `title_template`, `description_template`, `keywords_template`, `fonts_template`, `colors_template`, `active_template`, `date_created_template`, `date_updated_template`) VALUES
(1, 'logo.png', 'icono.png', 'cover.jpg', 'Sistema Ecommerce', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin tempor sem, at rutrum leo aliquet in. Phasellus et gravida magna. ', 'ecommerce,comercio electrónico,moda,sistemas', '{\"fontFamily\":\"%20%3Clink%20rel%3D%22preconnect%22%20href%3D%22https%3A%2F%2Ffonts.googleapis.com%22%3E%0A%20%20%3Clink%20rel%3D%22preconnect%22%20href%3D%22https%3A%2F%2Ffonts.gstatic.com%22%20crossorigin%3E%0A%20%20%3Clink%20href%3D%22https%3A%2F%2Ffonts.googleapis.com%2Fcss2%3Ffamily%3DUbuntu%2BCondensed%26family%3DUbuntu%3Aital%2Cwght%400%2C300%3B0%2C400%3B0%2C500%3B0%2C700%3B1%2C300%3B1%2C400%3B1%2C500%3B1%2C700%26display%3Dswap%22%20rel%3D%22stylesheet%22%3E\",\"fontBody\":\"Ubuntu\",\"fontSlide\":\"Ubuntu Condensed\"}', '[{\"top\":{\"background\":\"black\",\"color\":\"white\"}},{\"template\":\n{\"background\":\"#47BAC1\",\"color\":\"white\"}}]', 'ok', '2022-09-22', '2024-05-20 22:22:47'),
(2, 'logo.png', 'icono.png', 'cover.jpg', 'Sistema Ecommerce', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin tempor sem, at rutrum leo aliquet in. Phasellus et gravida magna. ', 'ecommerce,comercio electrónico,moda,sistemas', '{\"fontFamily\":\"%3Clink%20rel%3D%22preconnect%22%20href%3D%22https%3A%2F%2Ffonts.googleapis.com%22%3E%0A%3Clink%20rel%3D%22preconnect%22%20href%3D%22https%3A%2F%2Ffonts.gstatic.com%22%20crossorigin%3E%0A%3Clink%20href%3D%22https%3A%2F%2Ffonts.googleapis.com%2Fcss2%3Ffamily%3DMontserrat%3Awght%40300%3B700%26display%3Dswap%22%20rel%3D%22stylesheet%22%3E\",\"fontBody\":\"Montserrat\",\"fontSlide\":\"Montserrat\"}', '[{\"top\":{\"background\":\"#03f9b6\",\"color\":\"black\"}},{\"template\":{\"background\":\"#c147b5\",\"color\":\"white\"}}]', 'Null', '2022-09-22', '2024-05-20 22:22:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `name_user` text,
  `email_user` text,
  `password_user` text,
  `token_user` text,
  `token_exp_user` text,
  `method_user` text,
  `verification_user` int NOT NULL DEFAULT '0',
  `confirm_user` text,
  `country_user` text,
  `department_user` text,
  `city_user` text,
  `address_user` text,
  `phone_user` text,
  `date_created_user` date DEFAULT NULL,
  `date_updated_user` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name_user`, `email_user`, `password_user`, `token_user`, `token_exp_user`, `method_user`, `verification_user`, `confirm_user`, `country_user`, `department_user`, `city_user`, `address_user`, `phone_user`, `date_created_user`, `date_updated_user`) VALUES
(4, 'Tutoriales A Tu Alcance', 'correo.tutorialesatualcance@gmail.com', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MTY4NDMzNTUsImV4cCI6MTcxNjkyOTc1NSwiZGF0YSI6eyJpZCI6IjQiLCJlbWFpbCI6ImNvcnJlby50dXRvcmlhbGVzYXR1YWxjYW5jZUBnbWFpbC5jb20ifX0.TH9CcZLs-uEDGc-O2xJty22z523jj5Do4UGAb2bMxXA', '1716929755', 'google', 1, NULL, 'Colombia', 'Antioquia', 'Envigado', 'Calle 43 # 33', '57_2352562436', '2024-01-24', '2024-05-27 22:41:21'),
(5, 'Juan Urrego', 'juanu@gmail.com', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MDcxNjIwNjcsImV4cCI6MTcwNzI0ODQ2NywiZGF0YSI6eyJpZCI6IjUiLCJlbWFpbCI6Imp1YW51QGdtYWlsLmNvbSJ9fQ.Gykr20dbITTQzMtxeGvqzaZ-bTXKGoClEjMvdiUnACk', '1707248467', 'directo', 1, 'fc42ho3p8elrd91t6kb0', 'Colombia', 'Cundinamarca', 'Bogotá', 'Calle 34 # 45', '57_1354135213', '2024-01-25', '2024-02-05 19:58:38'),
(6, 'Juan Fernando Urrego', 'vivirdelainternet@gmail.com', '$2a$07$azybxcags23425sdg23sdebwAHuUuSFHF3NY2PY1Aj/Vn/KCI5xtW', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MTY1ODc4NTEsImV4cCI6MTcxNjY3NDI1MSwiZGF0YSI6eyJpZCI6IjYiLCJlbWFpbCI6InZpdmlyZGVsYWludGVybmV0QGdtYWlsLmNvbSJ9fQ.DJpGBE49olpeBU6XABUoF9bI476xgAXTNR_J77-ky8Y', '1716674251', 'directo', 1, 'y4uf9xdc58sh6z30orvb', NULL, NULL, NULL, NULL, NULL, '2024-05-24', '2024-05-24 22:47:15'),
(7, 'Wilmer Suma', 'wilmersuma@gmail.com', '$2a$07$azybxcags23425sdg23sdey68q/TGWyZ6WXugNle6t/xN6nM0IUju', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MTY2OTI1OTIsImV4cCI6MTcxNjc3ODk5MiwiZGF0YSI6eyJpZCI6IjciLCJlbWFpbCI6IndpbG1lcnN1bWFAZ21haWwuY29tIn19.8mb0Sw4s4lC7EGcK6eLzMH-mBPJsKx6jNWk2Ts0hOLg', '1716778992', 'directo', 1, 'hnymq5rlp8s20xudikv3', 'Peru', 'Peru', 'Cusco', 'san sebastian', '51_900904592_', '2024-05-26', '2024-05-26 03:03:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variants`
--

CREATE TABLE `variants` (
  `id_variant` int NOT NULL,
  `id_product_variant` int DEFAULT '0',
  `type_variant` text,
  `media_variant` text,
  `description_variant` text,
  `cost_variant` double NOT NULL DEFAULT '0',
  `price_variant` double NOT NULL DEFAULT '0',
  `offer_variant` text,
  `end_offer_variant` date DEFAULT NULL,
  `stock_variant` int NOT NULL DEFAULT '0',
  `date_created_variant` date DEFAULT NULL,
  `date_updated_variant` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `variants`
--

INSERT INTO `variants` (`id_variant`, `id_product_variant`, `type_variant`, `media_variant`, `description_variant`, `cost_variant`, `price_variant`, `offer_variant`, `end_offer_variant`, `stock_variant`, `date_created_variant`, `date_updated_variant`) VALUES
(2, 1, 'gallery', '[\"78123.jpg\",\"87200.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-07-26', '2023-08-30 20:45:29'),
(7, 1, 'gallery', '[\"61137.jpg\",\"17566.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-07-28', '2023-08-30 20:45:41'),
(9, 1, 'gallery', '[\"59749.jpg\",\"19866.jpg\"]', 'Conjunto Azul', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:45:43'),
(10, 4, 'gallery', '[\"28350.jpg\",\"11684.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-07-26', '2023-08-30 20:45:59'),
(11, 4, 'gallery', '[\"21325.jpg\",\"86726.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-07-28', '2023-08-30 20:46:03'),
(12, 4, 'gallery', '[\"59749.jpg\",\"19866.jpg\"]', 'Conjunto Azul', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:46:08'),
(13, 5, 'gallery', '[\"20984.jpg\",\"98565.jpg\"]', 'Conjunto Azul', 100, 200, '150', '0000-00-00', 100, '2023-07-26', '2023-08-30 20:46:12'),
(14, 5, 'gallery', '[\"61137.jpg\",\"17566.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-07-28', '2023-08-30 20:46:18'),
(15, 5, 'gallery', '[\"51505.jpg\",\"42147.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:46:21'),
(16, 6, 'gallery', '[\"38789.jpg\",\"71099.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:46:25'),
(17, 6, 'gallery', '[\"26258.jpg\",\"79873.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:46:31'),
(18, 7, 'gallery', '[\"85656.jpg\",\"50072.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:46:39'),
(19, 7, 'gallery', '[\"85265.jpg\",\"44462.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:46:46'),
(20, 8, 'gallery', '[\"81003.jpg\",\"28510.jpg\"]', 'Conjunto deportivo verde', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:46:51'),
(21, 9, 'gallery', '[\"78123.jpg\",\"87200.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-07-26', '2023-08-30 20:46:58'),
(22, 9, 'gallery', '[\"61137.jpg\",\"17566.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-07-28', '2023-08-30 20:47:03'),
(23, 9, 'gallery', '[\"59749.jpg\",\"19866.jpg\"]', 'Conjunto Azul', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:47:07'),
(24, 10, 'gallery', '[\"28350.jpg\",\"11684.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-07-26', '2023-08-30 20:47:12'),
(25, 10, 'gallery', '[\"21325.jpg\",\"86726.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-07-28', '2023-08-30 20:47:18'),
(26, 10, 'gallery', '[\"59749.jpg\",\"19866.jpg\"]', 'Conjunto Azul', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:47:22'),
(27, 11, 'gallery', '[\"20984.jpg\",\"98565.jpg\"]', 'Conjunto Azul', 100, 200, '150', '0000-00-00', 100, '2023-07-26', '2023-08-30 20:47:26'),
(28, 11, 'gallery', '[\"61137.jpg\",\"17566.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-07-28', '2023-08-30 20:47:31'),
(29, 11, 'gallery', '[\"51505.jpg\",\"42147.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:47:34'),
(30, 12, 'gallery', '[\"38789.jpg\",\"71099.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:47:40'),
(31, 12, 'gallery', '[\"26258.jpg\",\"79873.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:47:44'),
(32, 13, 'gallery', '[\"86981.jpg\",\"88573.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:47:54'),
(33, 13, 'gallery', '[\"40517.jpg\",\"54102.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:47:58'),
(34, 14, 'gallery', '[\"81003.jpg\",\"28510.jpg\"]', 'Conjunto deportivo verde', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:48:02'),
(35, 15, 'gallery', '[\"78123.jpg\",\"87200.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-07-26', '2023-08-30 20:48:07'),
(36, 15, 'gallery', '[\"61137.jpg\",\"17566.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-07-28', '2023-08-30 20:48:10'),
(37, 15, 'gallery', '[\"59749.jpg\",\"19866.jpg\"]', 'Conjunto Azul', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:48:15'),
(38, 16, 'gallery', '[\"28350.jpg\",\"11684.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-07-26', '2023-08-30 20:48:20'),
(39, 16, 'gallery', '[\"21325.jpg\",\"86726.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-07-28', '2023-08-30 20:48:25'),
(40, 16, 'gallery', '[\"59749.jpg\",\"19866.jpg\"]', 'Conjunto Azul', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:48:33'),
(41, 17, 'gallery', '[\"20984.jpg\",\"98565.jpg\"]', 'Conjunto Azul', 100, 200, '150', '0000-00-00', 100, '2023-07-26', '2023-09-21 21:46:38'),
(42, 17, 'gallery', '[\"61137.jpg\",\"17566.jpg\"]', 'Conjunto Blanco', 100, 180, '140', '2023-10-01', 0, '2023-07-28', '2023-09-21 22:34:36'),
(43, 17, 'gallery', '[\"51505.jpg\",\"42147.jpg\"]', 'Conjunto Beige', 100, 210, '180', '0000-00-00', 30, '2023-08-03', '2023-09-21 21:47:37'),
(44, 18, 'gallery', '[\"38789.jpg\",\"71099.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:48:49'),
(45, 18, 'gallery', '[\"26258.jpg\",\"79873.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:48:54'),
(46, 19, 'gallery', '[\"86981.jpg\",\"88573.jpg\"]', 'Conjunto Blanco', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:48:57'),
(47, 19, 'gallery', '[\"40517.jpg\",\"54102.jpg\"]', 'Conjunto Beige', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:49:01'),
(48, 20, 'gallery', '[\"81003.jpg\",\"28510.jpg\"]', 'Conjunto deportivo verde', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:49:06'),
(49, 21, 'gallery', '[\"23224.jpg\",\"34013.jpg\",\"66353.jpg\"]', 'Tennis Verde', 100, 200, '150', '0000-00-00', 0, '2023-08-03', '2023-08-30 20:49:12'),
(50, 21, 'gallery', '[\"38033.jpg\",\"97518.jpg\",\"79550.jpg\",\"41346.jpg\",\"98179.jpg\"]', 'Tennis Azul', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:49:18'),
(51, 21, 'gallery', '[\"21891.jpg\",\"88137.jpg\",\"69877.jpg\",\"29563.jpg\",\"61658.jpg\"]', 'Tennis Rojo', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:49:25'),
(52, 22, 'gallery', '[\"38033.jpg\",\"97518.jpg\",\"79550.jpg\",\"41346.jpg\",\"98179.jpg\"]', 'Tennis Azul', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:49:34'),
(53, 22, 'gallery', '[\"99902.jpg\",\"61653.jpg\",\"77377.jpg\",\"34013.jpg\",\"66353.jpg\"]', 'Tennis Verde', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:49:38'),
(54, 22, 'gallery', '[\"21891.jpg\",\"88137.jpg\",\"69877.jpg\",\"29563.jpg\",\"61658.jpg\"]', 'Tennis Rojo', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:49:43'),
(55, 23, 'gallery', '[\"21891.jpg\",\"88137.jpg\",\"69877.jpg\",\"29563.jpg\",\"61658.jpg\"]', 'Tennis Rojo', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:49:49'),
(56, 23, 'gallery', '[\"99902.jpg\",\"61653.jpg\",\"77377.jpg\",\"34013.jpg\",\"66353.jpg\"]', 'Tennis Verde', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:49:55'),
(57, 23, 'gallery', '[\"38033.jpg\",\"97518.jpg\",\"79550.jpg\",\"41346.jpg\",\"98179.jpg\"]', 'Tennis Azul', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:50:12'),
(58, 24, 'gallery', '[\"82088.jpg\",\"45600.jpg\"]', 'Calzado masculino', 100, 200, '150', '0000-00-00', 100, '2023-08-03', '2023-08-30 20:50:24'),
(59, 25, 'video', 'https://youtu.be/sj8dV_gPKYw', 'Curso de CSS', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:06'),
(60, 26, 'video', 'https://youtu.be/OVLptbCMny0', 'Curso de Bootstrap', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:10'),
(61, 27, 'video', 'https://youtu.be/Sl5FaskVpD4', 'Curso de javascript', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:11'),
(62, 28, 'video', 'https://youtu.be/QnQ9uhaa9sk', 'Curso de jQuery', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:12'),
(63, 29, 'video', 'https://youtu.be/ntiWg5GIzAc', 'Curso de Canvas', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:13'),
(64, 30, 'video', 'https://youtu.be/hZsQ_vVPwW0', 'Curso de PHP', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:14'),
(65, 31, 'video', 'https://youtu.be/sj8dV_gPKYw', 'Curso de CSS', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:15'),
(66, 32, 'video', 'https://youtu.be/OVLptbCMny0', 'Curso de Bootstrap', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:16'),
(67, 33, 'video', 'https://youtu.be/Sl5FaskVpD4', 'Curso de javascript', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:20'),
(68, 34, 'video', 'https://youtu.be/QnQ9uhaa9sk', 'Curso de jQuery', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:21'),
(69, 35, 'video', 'https://youtu.be/ntiWg5GIzAc', 'Curso de Canvas', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:23'),
(70, 36, 'video', 'https://youtu.be/hZsQ_vVPwW0', 'Curso de PHP', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:24'),
(71, 37, 'video', 'https://youtu.be/sj8dV_gPKYw', 'Curso de CSS', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:25'),
(72, 38, 'video', 'https://youtu.be/OVLptbCMny0', 'Curso de Bootstrap', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:26'),
(73, 39, 'video', 'https://youtu.be/Sl5FaskVpD4', 'Curso de javascript', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:29'),
(74, 40, 'video', 'https://youtu.be/QnQ9uhaa9sk', 'Curso de jQuery', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:31'),
(75, 41, 'video', 'https://youtu.be/ntiWg5GIzAc', 'Curso de Canvas', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:32'),
(76, 42, 'video', 'https://youtu.be/hZsQ_vVPwW0', 'Curso de PHP', 10, 30, '19', '0000-00-00', 0, '2023-08-05', '2023-08-30 20:51:33'),
(77, 43, 'gallery', '[\"72409.jpg\"]', 'Collar', 10, 0, '0', '0000-00-00', 100, '2023-08-08', '2023-08-30 20:52:05'),
(78, 44, 'gallery', '[\"36094.jpg\"]', 'Maleta Gris', 10, 0, '0', '0000-00-00', 100, '2023-08-08', '2023-08-30 20:52:09'),
(79, 45, 'gallery', '[\"51340.jpg\"]', 'Maleta Verde', 10, 0, '0', '0000-00-00', 100, '2023-08-08', '2023-08-30 20:52:10'),
(80, 46, 'gallery', '[\"72980.jpg\"]', 'Anillo', 10, 0, '0', '0000-00-00', 100, '2023-08-08', '2023-08-30 20:52:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visits`
--

CREATE TABLE `visits` (
  `id_visit` int NOT NULL,
  `ip_visit` text,
  `country_visit` text,
  `region_visit` text,
  `city_visit` text,
  `date_created_visit` date DEFAULT NULL,
  `date_updated_visit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `visits`
--

INSERT INTO `visits` (`id_visit`, `ip_visit`, `country_visit`, `region_visit`, `city_visit`, `date_created_visit`, `date_updated_visit`) VALUES
(1, '181.132.146.224', 'Colombia', 'Antioquia', 'Envigado', '2024-05-20', '2024-05-27 22:24:07'),
(2, '101.44.176.0', 'Mexico', 'Mexico City', 'Mexico City', '2024-05-27', '2024-05-27 15:45:44'),
(3, '102.177.160.0', 'Ecuador', 'Pichincha', 'Quito', '2024-05-27', '2024-05-27 15:46:08'),
(4, '102.38.204.0', 'Peru', 'Lima Province', 'Lima', '2024-05-27', '2024-05-27 15:46:26'),
(5, '1.178.48.0', 'Argentina', 'Buenos Aires', 'Buenos Aires', '2024-05-27', '2024-05-27 15:46:46'),
(6, '102.217.238.0', 'Colombia', 'Bogota D.C.', 'Bogotá', '2024-05-27', '2024-05-27 15:47:02'),
(7, '102.38.236.0', 'Ecuador', 'Pichincha', 'Quito', '2024-05-27', '2024-05-27 15:47:54'),
(8, '103.14.26.255', 'Mexico', 'Mexico City', 'Mexico City', '2024-05-27', '2024-05-27 15:48:56'),
(9, '104.106.95.255', 'Peru', 'Lima Province', 'Lima', '2024-05-27', '2024-05-27 15:49:28'),
(10, '102.217.237.255', 'Argentina', 'Buenos Aires F.D.', 'Buenos Aires', '2024-05-27', '2024-05-27 15:49:45'),
(11, '103.219.169.255', 'Colombia', 'Bogota D.C.', 'Bogota D.C.', '2024-05-27', '2024-05-27 15:49:56'),
(12, '1.178.255.255', 'Spain', 'Castellon', 'Torreblanca', '2024-05-27', '2024-05-27 15:55:20'),
(13, '181.132.146.224', 'Colombia', 'Antioquia', 'Envigado', '2024-05-27', '2024-05-27 22:24:33'),
(14, '190.144.218.193', 'Colombia', 'Bogota D.C.', 'Bogotá', '2024-05-27', '2024-05-28 00:27:52'),
(15, '40.77.167.73', 'United States', 'Virginia', 'Boydton', '2024-05-27', '2024-05-28 00:43:01'),
(16, '52.167.144.186', 'United States', 'Virginia', 'Boydton', '2024-05-28', '2024-05-28 05:03:56'),
(17, '181.132.146.224', 'Colombia', 'Antioquia', 'Envigado', '2024-05-28', '2024-05-28 14:03:30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indices de la tabla `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id_favorite`),
  ADD KEY `id_product_favorite` (`id_product_favorite`),
  ADD KEY `id_user_favorite` (`id_user_favorite`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_variant_order` (`id_variant_order`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_category_product` (`id_category_product`),
  ADD KEY `id_subcategory_product` (`id_subcategory_product`);

--
-- Indices de la tabla `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indices de la tabla `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id_social`);

--
-- Indices de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id_subcategory`),
  ADD KEY `id_category_subcategory` (`id_category_subcategory`);

--
-- Indices de la tabla `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id_template`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id_variant`),
  ADD KEY `id_product_variant` (`id_product_variant`);

--
-- Indices de la tabla `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id_visit`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `banners`
--
ALTER TABLE `banners`
  MODIFY `id_banner` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `carts`
--
ALTER TABLE `carts`
  MODIFY `id_cart` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id_favorite` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `slides`
--
ALTER TABLE `slides`
  MODIFY `id_slide` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `socials`
--
ALTER TABLE `socials`
  MODIFY `id_social` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id_subcategory` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `templates`
--
ALTER TABLE `templates`
  MODIFY `id_template` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `variants`
--
ALTER TABLE `variants`
  MODIFY `id_variant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `visits`
--
ALTER TABLE `visits`
  MODIFY `id_visit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`id_product_favorite`) REFERENCES `products` (`id_product`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`id_user_favorite`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_variant_order`) REFERENCES `variants` (`id_variant`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category_product`) REFERENCES `categories` (`id_category`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_subcategory_product`) REFERENCES `subcategories` (`id_subcategory`);

--
-- Filtros para la tabla `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`id_category_subcategory`) REFERENCES `categories` (`id_category`);

--
-- Filtros para la tabla `variants`
--
ALTER TABLE `variants`
  ADD CONSTRAINT `variants_ibfk_1` FOREIGN KEY (`id_product_variant`) REFERENCES `products` (`id_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
