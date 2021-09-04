CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `email`, `name`) VALUES
(1, 'test', 'bestframeworkindaworld@gmail.com'),
(2, 'test2', 'bestframeworkindaworld2@gmail.com');

ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;