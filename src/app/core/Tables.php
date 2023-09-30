<?php

class Tables
{
    public const PROFILE_TABLE =
    "CREATE TABLE IF NOT EXISTS profile (
        profile_id             INT             AUTO_INCREMENT      PRIMARY KEY,
        username            VARCHAR(20)     NOT NULL,
        password            VARCHAR(64)     NOT NULL,
        role                VARCHAR(20)     NOT NULL
    ";

    public const PROFILE_DESC_TABLE =
    "CREATE TABLE IF NOT EXISTS profile_desc (
        profile_id             INT             PRIMARY KEY,
        nama_panggilan      VARCHAR(64),
        nama_lengkap        VARCHAR(128),
        umur                INT,
        hobi                VARCHAR(256),
        interest            VARCHAR(256),
        video_perkenalan    VARCHAR(256),
        gambar_profile      VARCHAR(256),
        zodiak              VARCHAR(64),
        love_language       VARCHAR(64),
        mbti                VARCHAR(64),
        tinggi_badan        INT,
        agama               VARCHAR(64),
        ketidaksukaan       VARCHAR(256),
        domisili            VARCHAR(256),
        FOREIGN KEY (profile_id) REFERENCES profile(profile_id)
    );";

    public const PROFILE_CONTACT_TABLE =
    "CREATE TABLE IF NOT EXISTS profile_contact (
        profile_id             INT             PRIMARY KEY,
        contact_person      VARCHAR(255),
        FOREIGN KEY (profile_id) REFERENCES profile(profile_id)
    ";

    public const DATE_TABLE =
    "CREATE TABLE IF NOT EXISTS date (
        date_id             INT             AUTO_INCREMENT      PRIMARY KEY,
        profile_id_1           INT             NOT NULL,
        profile_id_2           INT             NOT NULL,
        FOREIGN KEY (profile_id_1) REFERENCES profile(profile_id),
        FOREIGN KEY (profile_id_2) REFERENCES profile(profile_id)
    );";

    public const NOTIFICATION_TABLE =
    "CREATE TABLE IF NOT EXISTS notification (
        notification_id     INT             AUTO_INCREMENT      PRIMARY KEY,
        jenis_notifikasi    VARCHAR(64)     NOT NULL,
        profile_id_sender      INT             NOT NULL,
        profile_id_receiver    INT             NOT NULL,
        isi_notifikasi      VARCHAR(255)    NOT NULL,
        sudah_dibaca        BOOLEAN         NOT NULL,
        FOREIGN KEY (profile_id_sender) REFERENCES profile(profile_id),
        FOREIGN KEY (profile_id_receiver) REFERENCES profile(profile_id)
    );";
}