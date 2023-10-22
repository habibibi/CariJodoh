-- CreateTable
CREATE TABLE `security` (
    `security_id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(191) NOT NULL UNIQUE,
    `password` VARCHAR(191) NOT NULL,

    PRIMARY KEY (`security_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `report` (
    `report_id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id_reporter` INTEGER NOT NULL,
    `user_id_reported` INTEGER NOT NULL,
    `report_detail` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`report_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `date_history` (
    `history_id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id_1` INTEGER NOT NULL,
    `user_id_2` INTEGER NOT NULL,
    `timestamp` DATETIME(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
    `location` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`history_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
