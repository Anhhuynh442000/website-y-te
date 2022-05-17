USE phpmvc;

--
--  `medical_users`
--

INSERT INTO `medical_users` (`id`, `email`, `password`, `status`, `created_at`, `token`, `face_id`, `role`) VALUES
(1, 'admin@mail.com', '$2y$10$iWwK565N9N0KPrEijrClVelh8ZAGFdR8BN2cAt3AZWcwTQcCxBVuO', 1, '2022-04-07 10:16:18', NULL, NULL, 1),
(2, 'doctor1@mail.com', '$2y$10$3VWXVhKAV/KLTw.JW0NkhehTro4ILrX4bbnqjo53PpBa4uFVin24C', 1, '2022-04-07 10:17:03', NULL, NULL, 2),
(3, 'doctor2@mail.com', '$2y$10$xjsU2yjsWVhPM.GHqCgSDuR7UThvOEtm9InjuqIOZfjmsK.a86tLm', 1, '2022-04-07 10:17:24', NULL, NULL, 2);

ALTER TABLE `medical_users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
--  `medical_user_profiles`
--

INSERT INTO `medical_user_profiles` (`id`, `first_name`, `last_name`, `birthday`, `gender`, `avatar`, `address`, `phone`, `user_id`) VALUES
(1, 'Admin', '1', '2022-04-07', 'Male', NULL, 'Admin', '0123456789', 1),
(2, 'Doctor', '1', '2022-04-07', 'Male', NULL, 'Doctor 1', '0123456789', 2),
(3, 'Doctor', '2', '2022-04-08', 'Female', NULL, 'Doctor 1', '0123456789', 3);

ALTER TABLE `medical_user_profiles`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
