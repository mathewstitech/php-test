-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2018 at 03:50 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `recipe_id`, `rating`) VALUES
(1, 1, 4),
(2, 1, 3),
(3, 1, 4),
(4, 1, 5),
(5, 2, 3),
(6, 3, 4),
(7, 3, 2),
(8, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `prep_time` int(11) NOT NULL,
  `difficulty` int(11) NOT NULL,
  `vegetarian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `prep_time`, `difficulty`, `vegetarian`) VALUES
(1, 'Chicken Curry', 10, 3, 0),
(2, 'Chicken Curry2', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `created`, `modified`) VALUES
(1, 'Mike', 'Dalisay', 'mike@codeofaninja.com', '$2y$10$y0io4H3zwRwIGMYktS5v9.Qu4qYHJ1C5TkWJtVur9FDQboKtoqavW', '0000-00-00 00:00:00', '2018-11-21 05:42:00'),
(2, 'Mike', 'Dalisay', 'mike@codeofaninja.com', '$2y$10$N4dssa0bCIj4LtjMuAMwQuo.F9NzgbIzldSK6rifFoPTsv8E.DbTi', '0000-00-00 00:00:00', '2018-11-21 05:42:19'),
(3, 'Mike', 'Dalisay', 'mike@codeofaninja.com', '$2y$10$97TdFOlxgcN8bkiT05t4S./MpK0FsDU4WA2HENvY6JuEODEPZdxYe', '0000-00-00 00:00:00', '2018-11-21 05:43:16'),
(4, 'Mike', 'Dalisay', 'mike@codeofaninja.com', '$2y$10$mXOl2VpmxMeGNR3xT0ETeuOy8nKerZrMRkEvJ1I7ehbrRcJv6.32W', '0000-00-00 00:00:00', '2018-11-21 05:43:35'),
(5, '', '', '', '$2y$10$VJ3x.HM44nEJEp6TwVJqHOCjHYf3QYxB/BoxBqBQwZvB.z73ushDu', '0000-00-00 00:00:00', '2018-11-21 05:43:57'),
(6, '', '', '', '$2y$10$JCoUXeXMKCwokyg5nsukkecHJ.PRszh4DFLrJgeKR6UXThy01PM/2', '0000-00-00 00:00:00', '2018-11-21 05:44:30'),
(7, 'Mike', 'Dalisay', 'mike@codeofaninja.com', '$2y$10$QS267W4eTmfD2LuJDYIkxePaoJvUqNq01vony2nkVkI.45cyu4TjS', '0000-00-00 00:00:00', '2018-11-21 07:53:35'),
(8, 'Mike', 'Dalisay', 'mike@codeofaninja.com', '$2y$10$zpyB0IDuSKpviHoXNhofmez9fUuJcfuubCgUpuMewwMjOUydbdTvW', '0000-00-00 00:00:00', '2018-11-21 07:59:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
