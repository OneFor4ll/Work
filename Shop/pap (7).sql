-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Jul-2023 às 07:26
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pap`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cart_products`
--

CREATE TABLE `cart_products` (
  `id_product` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `selected_size` varchar(20) DEFAULT NULL,
  `selected_color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cart_products`
--

INSERT INTO `cart_products` (`id_product`, `user_id`, `quantity`, `selected_size`, `selected_color`) VALUES
(186, 58, 1, 'M', 'blue'),
(187, 58, 1, 'M', 'blue'),
(203, 58, 1, 'M', 'red'),
(203, 63, 1, 'M', 'red'),
(203, 64, 1, 'L', 'red'),
(221, 55, 1, 'XL', 'blue'),
(220, 55, 1, 'M', 'blue'),
(221, 55, 1, 'S', 'blue'),
(243, 65, 1, 'XL', 'red');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `promotion` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `final_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `promotion`, `color`, `size`, `type`, `final_price`) VALUES
(242, 'Calças cargo largas', '20.00', 'Calças_cargo_largas.jpeg', '10', 'Blue', 'S,M,L', 'Calça', 18),
(243, 'Calças justas', '10.00', 'Calças_justas.jpeg', '0', 'Red', 'M,L,XL', 'Calça', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `status`, `city`, `country`, `address`, `phone_number`, `postal_code`, `first_name`, `last_name`) VALUES
(65, 'Admin', 'admin@gmail.com', '$2y$10$xohl23eliopKfNbY6SvrE.SQRJrIhLOXGlcHMm5YV1o/S2Ql66p5e', 'admin', '', 'Funchal', 'Portugal', 'Av. do Infante 6', '534256786', '9000-015 ', 'João', 'Pedro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_products`
--

CREATE TABLE `users_products` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users_products`
--

INSERT INTO `users_products` (`user_id`, `product_id`, `quantity`) VALUES
(1, 1, 0),
(2, 1, 0),
(18, 69, 0),
(18, 72, 0),
(18, 74, 0),
(18, 75, 0),
(18, 76, 0),
(18, 77, 0),
(18, 78, 0),
(18, 79, 0),
(18, 80, 0),
(18, 81, 0),
(18, 82, 0),
(18, 83, 0),
(18, 84, 0),
(18, 85, 0),
(18, 86, 0),
(18, 87, 0),
(18, 88, 0),
(18, 89, 0),
(18, 90, 0),
(18, 91, 0),
(18, 92, 0),
(18, 93, 0),
(18, 94, 0),
(18, 95, 0),
(18, 96, 0),
(18, 97, 0),
(18, 98, 0),
(18, 99, 0),
(18, 100, 0),
(18, 101, 0),
(18, 102, 0),
(18, 103, 0),
(18, 104, 0),
(18, 105, 0),
(18, 106, 0),
(18, 107, 0),
(18, 108, 0),
(18, 109, 0),
(18, 110, 0),
(18, 111, 0),
(18, 112, 0),
(18, 113, 0),
(18, 114, 0),
(18, 115, 0),
(18, 116, 0),
(18, 117, 0),
(18, 118, 0),
(18, 119, 0),
(18, 120, 0),
(18, 121, 0),
(18, 122, 0),
(18, 123, 0),
(18, 124, 0),
(18, 125, 0),
(18, 126, 0),
(18, 127, 0),
(18, 128, 0),
(18, 129, 0),
(18, 130, 0),
(18, 131, 0),
(18, 132, 0),
(18, 133, 0),
(18, 134, 0),
(18, 135, 0),
(18, 136, 0),
(18, 137, 0),
(18, 138, 0),
(18, 139, 0),
(18, 140, 0),
(18, 141, 0),
(18, 142, 0),
(18, 144, 0),
(18, 145, 0),
(18, 146, 0),
(18, 147, 0),
(18, 148, 0),
(18, 149, 0),
(18, 150, 0),
(18, 157, 0),
(18, 158, 0),
(18, 159, 0),
(18, 160, 0),
(18, 161, 0),
(18, 162, 0),
(18, 163, 0),
(18, 170, 0),
(18, 171, 0),
(18, 172, 0),
(18, 173, 0),
(18, 174, 0),
(18, 175, 0),
(18, 176, 0),
(18, 178, 0),
(18, 179, 0),
(18, 180, 0),
(18, 181, 0),
(18, 182, 0),
(19, 50, 0),
(19, 71, 0),
(19, 143, 0),
(19, 151, 0),
(19, 152, 0),
(19, 153, 0),
(19, 154, 0),
(19, 155, 0),
(19, 156, 0),
(19, 164, 0),
(19, 165, 0),
(19, 166, 0),
(19, 167, 0),
(19, 168, 0),
(19, 169, 0),
(19, 177, 0),
(48, 73, 0),
(55, 183, 0),
(55, 184, 0),
(55, 185, 0),
(55, 186, 0),
(55, 187, 0),
(55, 189, 0),
(55, 190, 0),
(55, 191, 0),
(55, 192, 0),
(55, 193, 0),
(55, 194, 0),
(55, 195, 0),
(55, 196, 0),
(55, 197, 0),
(55, 198, 0),
(55, 199, 0),
(55, 200, 0),
(55, 201, 0),
(55, 202, 0),
(55, 203, 0),
(55, 204, 0),
(55, 205, 0),
(55, 206, 0),
(55, 207, 0),
(55, 208, 0),
(55, 209, 0),
(55, 211, 0),
(55, 216, 0),
(55, 217, 0),
(55, 218, 0),
(55, 219, 0),
(55, 220, 0),
(55, 221, 0),
(55, 222, 0),
(55, 223, 0),
(55, 224, 0),
(55, 225, 0),
(55, 226, 0),
(55, 227, 0),
(55, 228, 0),
(55, 229, 0),
(55, 230, 0),
(55, 231, 0),
(55, 233, 0),
(55, 235, 0),
(55, 236, 0),
(55, 237, 0),
(55, 238, 0),
(55, 239, 0),
(55, 240, 0),
(55, 241, 0),
(56, 188, 0),
(56, 210, 0),
(56, 212, 0),
(56, 214, 0),
(58, 213, 0),
(64, 215, 0),
(65, 242, 0),
(65, 243, 0),
(65, 244, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users_products`
--
ALTER TABLE `users_products`
  ADD PRIMARY KEY (`user_id`,`product_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
