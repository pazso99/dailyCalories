# SQL
CREATE TABLE `foods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` varchar(50) NOT NULL,
  `name` varchar(60) NOT NULL,
  `carbs` double NOT NULL,
  `fiber` double NOT NULL,
  `sugar` double NOT NULL,
  `protein` double NOT NULL,
  `fat` double NOT NULL,
  `calorie` int(11) NOT NULL,
   PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `birth` date NOT NULL,
  `gender` varchar(30) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` double NOT NULL,
  `activity` varchar(30) NOT NULL,
  `ideal` varchar(30) NOT NULL,
  `idealpercentage` int(11) NOT NULL,
  `bmr` double NOT NULL,
  `bmi` double NOT NULL,
  `lbm` double NOT NULL,
  `bodyfat` double NOT NULL,
  `bodyfatpercentage` double NOT NULL,
  `tdee` int(11) NOT NULL,
  `dailycalorie` int(11) NOT NULL,
  `dailyprotein` double NOT NULL,
  `dailycarbs` double NOT NULL,
  `dailyfat` double NOT NULL,
  `dailyfiber` double NOT NULL,
  `dailysugar` double NOT NULL,
   PRIMARY KEY (`id`)
);

CREATE TABLE `dailyfoods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(40) NOT NULL,
  `user.id` int(11) NOT NULL,
  `food.eaten` varchar(100) NOT NULL,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`user.id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
