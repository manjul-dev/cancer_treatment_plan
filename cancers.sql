-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2021 at 07:44 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cancer_treatment_plan`
--

-- --------------------------------------------------------

--
-- Table structure for table `cancers`
--

CREATE TABLE `cancers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cancers`
--

INSERT INTO `cancers` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Acute Lymphoblastic Leukemia', NULL, NULL),
(2, 'Acute Myeloid Leukemia', NULL, NULL),
(3, 'Adolescents', NULL, NULL),
(4, 'Adrenocortical Carcinoma', NULL, NULL),
(5, 'Anal Cancer', NULL, NULL),
(6, 'Astrocytomas', NULL, NULL),
(7, 'Atypical Teratoid', NULL, NULL),
(8, 'Basal Cell Carcinoma of the Skin', NULL, NULL),
(9, 'Bile Duct Cancer', NULL, NULL),
(10, 'Bladder Cancer', NULL, NULL),
(11, 'Bone Cancer', NULL, NULL),
(12, 'Brain Tumors', NULL, NULL),
(13, 'Breast Cancer', NULL, NULL),
(14, 'Bronchial Tumors', NULL, NULL),
(15, 'Burkitt Lymphoma', NULL, NULL),
(16, 'Carcinoid Tumor', NULL, NULL),
(17, 'Carcinoma of Unknown Primary', NULL, NULL),
(18, 'Cardiac Tumors', NULL, NULL),
(19, 'Cervical Cancer', NULL, NULL),
(20, 'Childhood Cancers', NULL, NULL),
(21, 'Cancers of Childhood', NULL, NULL),
(22, 'Embryonal Tumors', NULL, NULL),
(23, 'Endometrial Cancer', NULL, NULL),
(24, 'Ependymoma, Childhood', NULL, NULL),
(25, 'Esophageal Cancer', NULL, NULL),
(26, 'Esthesioneuroblastoma', NULL, NULL),
(27, 'Ewing Sarcoma', NULL, NULL),
(28, 'Extracranial Germ Cell Tumor', NULL, NULL),
(29, 'Extragonadal Germ Cell Tumor', NULL, NULL),
(30, 'Fallopian Tube Cancer', NULL, NULL),
(31, 'Fibrous Histiocytoma of Bone', NULL, NULL),
(32, 'Gallbladder Cancer', NULL, NULL),
(33, 'Gastric Cancer', NULL, NULL),
(34, 'Gastrointestinal Carcinoid Tumor', NULL, NULL),
(35, 'Gastrointestinal Stromal Tumors', NULL, NULL),
(36, 'Hairy Cell Leukemia', NULL, NULL),
(37, 'Head and Neck Cancer', NULL, NULL),
(38, 'Heart Tumors', NULL, NULL),
(39, 'Hepatocellular', NULL, NULL),
(40, 'Histiocytosis', NULL, NULL),
(41, 'Hodgkin Lymphoma', NULL, NULL),
(42, 'Hypopharyngeal Cancer', NULL, NULL),
(43, 'Intraocular Melanoma', NULL, NULL),
(44, 'Islet Cell Tumors', NULL, NULL),
(45, 'Kaposi Sarcoma', NULL, NULL),
(46, 'Kidney Cancer', NULL, NULL),
(47, 'Langerhans Cell Histiocytosis', NULL, NULL),
(48, 'Laryngeal Cancer', NULL, NULL),
(49, 'Leukemia', NULL, NULL),
(50, 'Lip and Oral Cavity Cancer', NULL, NULL),
(51, 'Liver Cancer', NULL, NULL),
(52, 'Lung Cancer', NULL, NULL),
(53, 'Lymphoma', NULL, NULL),
(54, 'Male Breast Cancer', NULL, NULL),
(55, 'Malignant Fibrous Histiocytoma of Bone and Osteosarcoma', NULL, NULL),
(56, 'Melanoma', NULL, NULL),
(57, 'Merkel Cell Carcinoma', NULL, NULL),
(58, 'Mesothelioma', NULL, NULL),
(59, 'Metastatic Cancer', NULL, NULL),
(60, 'Metastatic Squamous Neck Cancer with Occult Primary', NULL, NULL),
(61, 'Midline Tract Carcinoma With NUT Gene Changes', NULL, NULL),
(62, 'Mouth Cancer', NULL, NULL),
(63, 'Multiple Endocrine Neoplasia Syndromes', NULL, NULL),
(64, 'Multiple Myeloma/Plasma Cell Neoplasms', NULL, NULL),
(65, 'Mycosis Fungoides', NULL, NULL),
(66, 'Myelodysplastic Syndromes', NULL, NULL),
(67, 'Myelogenous Leukemia', NULL, NULL),
(68, 'Myeloid Leukemia', NULL, NULL),
(69, 'Myeloproliferative Neoplasms', NULL, NULL),
(70, 'Nasal Cavity and Paranasal Sinus Cancer', NULL, NULL),
(71, 'Nasopharyngeal Cancer', NULL, NULL),
(72, 'Neuroblastoma', NULL, NULL),
(73, 'Non-Hodgkin Lymphoma', NULL, NULL),
(74, 'Non-Small Cell Lung Cancer', NULL, NULL),
(75, 'Oral Cancer, Lip and Oral Cavity Cancer and Oropharyngeal Cancer', NULL, NULL),
(76, 'Osteosarcoma and Undifferentiated Pleomorphic Sarcoma of Bone Treatment', NULL, NULL),
(77, 'Ovarian Cancer', NULL, NULL),
(78, 'Pancreatic Cancer', NULL, NULL),
(79, 'Pancreatic Neuroendocrine Tumors', NULL, NULL),
(80, 'Papillomatosis', NULL, NULL),
(81, 'Paraganglioma', NULL, NULL),
(82, 'Paranasal Sinus and Nasal Cavity Cancer', NULL, NULL),
(83, 'Parathyroid Cancer', NULL, NULL),
(84, 'Rectal Cancer', NULL, NULL),
(85, 'Recurrent Cancer', NULL, NULL),
(86, 'Renal Cell Cancer', NULL, NULL),
(87, 'Retinoblastoma', NULL, NULL),
(88, 'Rhabdomyosarcoma', NULL, NULL),
(89, 'Skin Cancer', NULL, NULL),
(90, 'Small Cell Lung Cancer', NULL, NULL),
(91, 'Small Intestine Cancer', NULL, NULL),
(92, 'Soft Tissue Sarcoma', NULL, NULL),
(93, 'Thymoma and Thymic Carcinoma', NULL, NULL),
(94, 'Thyroid Cancer', NULL, NULL),
(95, 'Tracheobronchial Tumors', NULL, NULL),
(96, 'Transitional Cell Cancer of the Renal Pelvis and Ureter', NULL, NULL),
(97, 'Unknown Primary, Carcinoma of', NULL, NULL),
(98, 'Ureter and Renal Pelvis', NULL, NULL),
(99, 'Urethral Cancer', NULL, NULL),
(100, 'Uterine Cancer', NULL, NULL),
(101, 'Uterine Sarcoma', NULL, NULL),
(102, 'Vaginal Cancer', NULL, NULL),
(103, 'Vascular Tumors', NULL, NULL),
(104, 'Vulvar Cancer', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cancers`
--
ALTER TABLE `cancers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cancers`
--
ALTER TABLE `cancers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
