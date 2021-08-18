-- MySQL Script generated by MySQL Workbench
-- 01/28/20 15:11:47
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering


-- -----------------------------------------------------
-- Data for table `skoule`.`teacher`
-- -----------------------------------------------------
START TRANSACTION;
USE `skoule`;
INSERT INTO `skoule`.`teacher` (`id`, `firstname`, `lastname`, `job`, `status`, `created_at`, `updated_at`) VALUES (1, 'Morgan', 'Ator', 'Formateur PHP/MySQL', 1, DEFAULT, NULL);
INSERT INTO `skoule`.`teacher` (`id`, `firstname`, `lastname`, `job`, `status`, `created_at`, `updated_at`) VALUES (2, 'Djyp', 'Arade', 'Formateur PHP/MySQL', 1, DEFAULT, NULL);
INSERT INTO `skoule`.`teacher` (`id`, `firstname`, `lastname`, `job`, `status`, `created_at`, `updated_at`) VALUES (3, 'JB', 'Alle', 'Formateur PHP/MySQL', 1, DEFAULT, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `skoule`.`student`
-- -----------------------------------------------------
START TRANSACTION;
USE `skoule`;
INSERT INTO `skoule`.`student` (`id`, `firstname`, `lastname`, `status`, `created_at`, `updated_at`, `teacher_id`) VALUES (1, 'Dorian', 'Lalanne', 1, DEFAULT, NULL, 2);
INSERT INTO `skoule`.`student` (`id`, `firstname`, `lastname`, `status`, `created_at`, `updated_at`, `teacher_id`) VALUES (2, 'Alex', 'RedRokh', 1, DEFAULT, NULL, 1);
INSERT INTO `skoule`.`student` (`id`, `firstname`, `lastname`, `status`, `created_at`, `updated_at`, `teacher_id`) VALUES (3, 'Thomas', 'Dauphin', 1, DEFAULT, NULL, 1);
INSERT INTO `skoule`.`student` (`id`, `firstname`, `lastname`, `status`, `created_at`, `updated_at`, `teacher_id`) VALUES (4, 'Melanie', 'Fauchon', 1, DEFAULT, NULL, 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `skoule`.`app_user`
-- -----------------------------------------------------
START TRANSACTION;
USE `skoule`;
INSERT INTO `skoule`.`app_user` (`id`, `email`, `name`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES (1, 'lucie@skoule.fr', 'Lucie Copin', '$2y$10$EePMx53146HlfIrHN7Ooree78V5nlLrhNCM.dZ9wL8NbQXRJbWp1O', 'admin', 1, DEFAULT, NULL);
INSERT INTO `skoule`.`app_user` (`id`, `email`, `name`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES (2, 'adrien@skoule.fr', 'Adrien Delcarré', '$2y$10$CbxKjJ7khu/xmSlRCtDgSeChpi.2R83IjEvpFHTA1FhQ1ATY.4way', 'user', 1, DEFAULT, NULL);

COMMIT;
