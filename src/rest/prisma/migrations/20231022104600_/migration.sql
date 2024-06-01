-- CreateTable
CREATE TABLE `blocked` (
    `blocked_id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `username` VARCHAR(191) NOT NULL,
    `blocked_detail` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`blocked_id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- RenameIndex
ALTER TABLE `security` RENAME INDEX `username` TO `security_username_key`;
