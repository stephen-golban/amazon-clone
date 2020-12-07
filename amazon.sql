-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 01:36 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amazon`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `prod_id`, `prod_price`) VALUES
(25, 43, 68, '49.94'),
(26, 43, 70, '39.98');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `categoryImage` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryName`, `categoryImage`) VALUES
(13, 'Electronics', 'https://amlprintingservices.com/wp-content/uploads/2018/12/electrical-equipment.png'),
(14, 'Gaming and PC Accessories', 'https://static.digit.in/default/6cf17f8516c5b554860c732e2f07980aaef7aa3b.jpeg'),
(15, 'Video Games', 'https://store.ubi.com/on/demandware.static/-/Library-Sites-shared-library-web/default/dwccf23005/landings/2020/ubisoftplus-games-redesign/images_uplayplus_hero.jpg'),
(16, 'Men Fashion', 'https://i.pinimg.com/originals/be/49/10/be491016c161b2982d020a4951a82f06.jpg'),
(17, 'Women Fashion', 'https://24myfashion.com/2016/wp-content/uploads/2019/08/9.jpg'),
(18, 'Baby', 'https://infoteka.bg/wp-content/uploads/2020/06/babygoods.jpg'),
(19, 'Beauty and Makeup', 'https://mir-s3-cdn-cf.behance.net/project_modules/disp/4aaac059256501.5a1be4a97bc12.jpg'),
(20, 'Art and Crafts', 'https://i.pinimg.com/originals/58/53/1f/58531fb792fce4260f10803a3db79c70.jpg'),
(21, 'Computers and Consoles', 'https://mrlus.com/wp-content/uploads/2020/09/consoles-vs-gaming-pc.jpg'),
(22, 'Mobile Phones', 'https://www.iphone.ie/wp-content/uploads/2020/06/EverythingApplePro.jpg'),
(24, 'Automotive', 'https://carwow-uk-wp-1.imgix.net/tesla-roadster-model-y-model-s-cybertruck-1-lead-scaled.jpg?auto=format&cs=tinysrgb&fit=crop&h=800&ixlib=rb-1.1.0&q=60&w=1600');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard user', '{\"standard\" : 1}'),
(2, 'Administrator', '{\"admin\" : 1,\"moderator\" : 1}');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productName` varchar(300) NOT NULL,
  `productImage` varchar(1000) NOT NULL,
  `productDescription` varchar(1000) NOT NULL,
  `productPrice` varchar(200) NOT NULL,
  `productCategory` varchar(300) NOT NULL,
  `productRating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productName`, `productImage`, `productDescription`, `productPrice`, `productCategory`, `productRating`) VALUES
(7, 'AmazonBasics 36 Pack AAA High-Performance Alkaline Batteries', 'https://images-na.ssl-images-amazon.com/images/I/71nDX36Y9UL._AC_SL1026_.jpg', ' AAA 1.5-volt performance alkaline batteries; ideal for a variety of devices, including game controllers, toys, flashlights, digital cameras, and clocks\r\n10-year leak-free shelf life; air- and liquid-tight seal locks in the power until it’s needed thanks to the improved design, which includes dual crimps, a new zinc composition, and anti-corrosion components ', '8.70', 'Electronics', 3),
(8, 'AmazonBasics 60-Inch Lightweight Tripod with Bag', 'https://images-na.ssl-images-amazon.com/images/I/61vjUCzQCaL._AC_SL1484_.jpg', ' Lightweight tripod with adjustable-height legs and rubber feet\r\nCompatible with most video cameras, digital cameras, still cameras, GoPro devices, smartphone adapters (not included), and scopes.\r\nDelivers the speed and capacity you need to capture 4K Ultra HD video ', '36.98', 'Electronics', 5),
(9, 'AmazonBasics Double Braided Nylon Lightning to USB Cable', 'https://images-na.ssl-images-amazon.com/images/I/81T2DGhCZlL._AC_SL1500_.jpg', ' Apple MFi certified charging and syncing cable for your Apple devices\r\nCopper wire with added Kevlar to improve durability and strength; durable nylon fiber cloth provides protection, strength, and flexibility ', '3.99', 'Electronics', 5),
(10, 'AmazonBasics Backpack for SLR Cameras and Accessories-Black', 'https://images-na.ssl-images-amazon.com/images/I/81LpeKZIFmL._AC_SL1500_.jpg', ' exterior measures 11.75x8.75x14.5inch\r\nProduct Dimensions :11.75x8.75x14.5inch ', '34.00', 'Electronics', 3),
(11, 'AmazonBasics Straight Cable Lightning Car Charger', 'https://images-na.ssl-images-amazon.com/images/I/61u5zUMztwL._AC_SL1500_.jpg', ' Lightning car charger for charging portable Apple devices when traveling in the car\r\nApple MFi certification ensures complete charge and sync compatibility with iPhone XS / X / 8 Plus / 8 / 7 Plus / 7 / 6s Plus / 6s / 6 Plus / 6 / 5s / 5c / 5 / iPad Pro / iPad Air / Air 2 / iPad mini / mini 2 / mini 4 / iPad 4th gen / iPod Touch 5th gen / iPod nano 7th gen and Beats Pill+ ', '12.35', 'Electronics', 3),
(12, 'Azpen Dockall D100 - Qi Wireless Charger, Bluetooth Premium Speakers,', 'https://images-na.ssl-images-amazon.com/images/I/71Rca-FWKnL._AC_SL1500_.jpg', 'WIRELESS CHARGER: 3 charging coils allows the DockAll to charge compatible phones vertical or horizontal. 5W charging for most newer phones including iPhone, Samsung Galaxy, LG and more. ', '122.12', 'Electronics', 4),
(13, 'AmazonBasics 3-Button USB Wired Computer Mouse', 'https://m.media-amazon.com/images/I/71uotBbbjNL._AC_SL1500_.jpg', ' Smooth, precise and affordable USB-connected 3-button optical mouse\r\nHigh-definition (1000 dpi) optical tracking enables responsive cursor control for precise tracking and easy text selection\r\nThe 3-button wired mouse measures 4.3\" x 2.4\" x 1.35\" with a 4.92 foot (1.5 meter) cable ', '12.00', 'Electronics', 4),
(15, 'AmazonBasics Over-Ear Studio Monitor Headphones - Black ', 'https://images-na.ssl-images-amazon.com/images/I/71n83Gqlp6L._AC_SL1500_.jpg', ' Studio monitor headphones with over-the-ear design helps isolate sound and block outside noise; ideal for studio and field recording\r\nContoured ear-cups and self-adjustable, flexible leather headband promote long-lasting comfort\r\n90-degree swivel for single-ear use; ear-cups fold in for compact space-saving storage and transport\r\n40 mm diameter drivers; DJ-style 9.8-foot cord; detachable standard 6.3mm plug\r\nBacked by an AmazonBasics 1-year limited warranty ', '39.95', 'Electronics', 4),
(16, 'AmazonBasics Charging Dock for Nintendo Switch Pro Controller with USB Cable', 'https://images-na.ssl-images-amazon.com/images/I/61XAv1DXAUL._SL1500_.jpg', ' Charging dock for quickly and easily recharging a Nintendo Switch Pro Controller (not included)\r\nFully recharges an empty controller in less than 4.5 hours for fast results\r\nOCP, OVP, SCP protection for smart charging; LED indicator offers at-a-glance status update (red for charging; green for fully charged) ', '34.45', 'Electronics', 5),
(17, 'Vizio D-Series 24inch HD (720P) Smart LED TV', 'https://images-na.ssl-images-amazon.com/images/I/51dWnINQ0FL._AC_.jpg', 'Product works and looks like new. Backed by the 90-day Amazon Renewed Guarantee.\r\n- This pre-owned product has been professionally inspected, tested and cleaned by Amazon-qualified suppliers.\r\n- There will be no visible cosmetic imperfections when held at an arm’s length.\r\n- Products with batteries will exceed 80% capacity relative to new.', '129.99', 'Electronics', 3),
(18, 'Neveras portátiles Mini Coche Compresor Refrigerador Congelador', 'https://images-na.ssl-images-amazon.com/images/I/51itz-OjyWL._AC_SL1001_.jpg', ' -Compresor de alto rendimiento de 45 vatios para refrigeración, alcanza los -20 °C.\r\n-Unidad ultracompacta y portátil con asas de transporte.\r\n-Capacidad de almacenamiento de 15 L, capacidad para 20 latas, 6 botellas de vino.\r\n-Sistema de protección para la batería del vehículo, compatible con 12/24 V CC y 240 V CA.\r\n-Adecuado para uso en coches 4x4, autocaravanas, barcos, camiones, acampadas y mucho más. ', '549.99', 'Electronics', 4),
(19, 'Fully Automatic Compact Washer with Wheels', 'https://images-na.ssl-images-amazon.com/images/I/41hOwz0shmL._AC_SL1000_.jpg', 'Easy to Use: - This portable washing machine has 6 most commonly used programs including Normal, Quick, Heavy, Bulky, Delicate, and Spin Only. You are allowed to quickly start the machine the way you like. ', '289.00', 'Electronics', 3),
(20, 'Hamilton Beach Classic Hand and Stand Mixer, 4 Quarts, 6 Speeds', 'https://images-na.ssl-images-amazon.com/images/I/71FtqrUt7QL._AC_SL1500_.jpg', ' Two in one: lightweight hand mixer easily detaches from the base for extra mixing versatility to tackle any baking recipe.\r\nMix with ease: with 290 watts peak power and 6 adjustable speeds, plus Quick burst, you can tailor your kitchen mixer to take on any task at hand, from a fast whip to a slow stir. ', '44.99', 'Electronics', 4),
(21, 'Logitech G502 Hero High Performance Gaming Mouse', 'https://images-na.ssl-images-amazon.com/images/I/51IOmsWQVAL._AC_SL1050_.jpg', 'Hero 25K sensor through a software update from G HUB, this upgrade is free to all players: Our most advanced, with 1:1 tracking, 400+ ips, and 100 - 25,600 max dpi sensitivity plus zero smoothing, filtering, or acceleration', '39.99', 'Gaming and PC Accessories', 5),
(22, 'RUNMUS Gaming Headset Xbox One Headset with 7.1 Surround Sound, PS4 Headset with Noise Canceling Mic', 'https://images-na.ssl-images-amazon.com/images/I/61lnzTv2a0L._AC_SL1000_.jpg', '50mm Driver Delivers Surround Sound. Whether you\'re immersed in God of War or want to hear your enemies motion in Fortnite, PUBG or CS:GO, wearing a professional gaming headset does matters. With a 50mm driver, RUNMUS PS4 headset offers an incredibly surround sound for both games and music. ', '26.95', 'Gaming and PC Accessories', 4),
(23, 'Samsung SSD 860 EVO 1TB 2.5 Inch SATA III Internal SSD (MZ-76E1T0B/AM)', 'https://images-na.ssl-images-amazon.com/images/I/91JA5-hAnoL._AC_SL1500_.jpg', 'Compatible Devices 	Windows, Mac\r\nBrand 	SAMSUNG\r\nDigital Storage Capacity 	1 TB\r\nHardware Interface 	SATA 6.0 Gb/s\r\nType of product 	2.5 inches\r\nAbout this item\r\n\r\n    Make sure this fits by entering your model number.\r\n    Innovative V-Nand Technology: Powered by Samsung V-Nand Technology, the 860 Evo SSD offers optimized performance for everyday computing as well as rendering large-sized 4K videos and 3D data used by the latest applications ', '99.99', 'Gaming and PC Accessories', 4),
(24, 'SAMSUNG 970 EVO Plus SSD 2TB - M.2 NVMe Interface', 'https://images-na.ssl-images-amazon.com/images/I/813bvfaxuAL._AC_SL1500_.jpg', 'Brand 	SAMSUNG\r\nDigital Storage Capacity 	2 TB\r\nHardware Interface 	PCI Express x4\r\nType of product 	M.2 (2280)\r\nWrite Speed 	3300 megabits_per_second\r\nAbout this item\r\n\r\n    INNOVATIVE V-NAND TECHNOLOGY: Powered by Samsung V-NAND Technology, the 970 EVO Plus SSD’s NVMe interface (PCIe Gen 3.0 x4 NVMe 1.3) offers enhanced bandwidth, low latency, and power efficiency ideal for tech enthusiasts, high end gamers, and 4K & 3D content designers ', '249.99', 'Gaming and PC Accessories', 5),
(25, 'Corsair Vengeance LPX 16GB (2 X 8GB) DDR4 3600 (PC4-28800) C18 1.35V Desktop Memory - Black', 'https://images-na.ssl-images-amazon.com/images/I/518T3hrUY4L._AC_SL1200_.jpg', ' Hand-sorted memory chips ensure high performance with generous overclocking headroom.\r\nVengeance LPX is optimized for wide compatibility with the latest Intel and AMD DDR4 motherboards.\r\nA low-profile height of just 34mm ensures that vengeance LPX even fits in most small-form-factor builds. ', '66.99', 'Gaming and PC Accessories', 3),
(26, 'Acer Aspire 5 Slim Laptop, 15.6 inches Full HD', 'https://images-na.ssl-images-amazon.com/images/I/71vvXGmdKWL._AC_SL1500_.jpg', 'Brand 	Acer\r\nSeries 	A515-43-R19L\r\nDisplay Size 	15.6 Inches\r\nOperating System 	Windows 10 S\r\nProcessor Count 	2\r\nAbout this item\r\n\r\n    AMD Ryzen 3 3200U Dual Core Processor (Up to 3.5GHz); 4GB DDR4 Memory; 128GB PCIe NVMe SSD\r\n    15.6 inches full HD (1920 x 1080) widescreen LED backlit IPS display; AMD Radeon Vega 3 Mobile Graphics ', '458.00', 'Gaming and PC Accessories', 4),
(27, 'iBUYPOWER Gaming PC Computer Desktop Element MR 9320', 'https://images-na.ssl-images-amazon.com/images/I/715zrA5cmLL._AC_SL1500_.jpg', ' System: Intel i7-10700F 2.9GHz (4.8GHz Max Turbo) 16GB DDR4 RAM 240GB SSD 1TB HDD Genuine Windows 10 Home 64-bit\r\nGraphics: NVIDIA GeForce GTX 1660 Ti 6GB Dedicated Gaming Video Card VR Ready 1x DVI 1x HDMI 1x Display Port ', '999.99', 'Computers and Consoles', 5),
(28, 'Alienware 25 Gaming Monitor - AW2518Hf', 'https://images-na.ssl-images-amazon.com/images/I/71l%2BZ8gJMIL._AC_SL1280_.jpg', ' Designed for the enthusiast, the AW2518HF delivers a futuristic style and precise form with solid stability\r\nLightning-fast 240Hz native refresh rate combined with 1ms response time delivers buttery-smooth gameplay with virtually no input lag ', '396.99', 'Gaming and PC Accessories', 5),
(29, 'Art 101 142-Piece Wood Art Set Amazon Exclusive', 'https://images-na.ssl-images-amazon.com/images/I/911SJ1OjuJL._AC_SL1500_.jpg', '    Includes 24 Premium Core Colored Pencils which color, shade, and blend beautifully\r\n    Includes a variety of coloring and painting mediums, including crayons, oil pastels, and watercolors\r\n    Comes in a deluxe wooden carrying case with a drawer to easily organize your supplies\r\n    Choose between a trendy grey wash wood or cherry wood color for your case\r\n    Take your art set with you anywhere to color, draw, and create your next masterpiece\r\n', '26.89', 'Art and Crafts', 2),
(30, 'Ring Size Adjuster for Loose Rings - 12 Pack', 'https://images-na.ssl-images-amazon.com/images/I/71hdH4MjpxL._AC_SL1500_.jpg', '💍FIT 90% OF RINGS and EASY TO USE - Come in 2 sizes: (6 pcs) ø2mm X 10cm coil is best for thin rings that are less then 3mm in thickness and the (6 pcs) ø3mm X 10cm flat coils are best for rings up to 5mm in thickness. ', '7.99', 'Art and Crafts', 1),
(31, 'Made in USA Brown Kraft Paper Jumbo Roll', 'https://images-na.ssl-images-amazon.com/images/I/81VyAMFJt7L._AC_SL1500_.jpg', ' 100% Recycled Brown Kraft Paper MADE IN USA by Creative Paper Co\r\nIndustrial Grade 40# Paper Weight makes it Ideal for Wrapping and Multiuse\r\nUn-Waxed and Uncoated, Eco-Friendly Traditional Brown Craft Paper, Not a Butcher Paper ', '14.89', 'Art and Crafts', 2),
(32, 'Assorted Color Felt Fabric Sheets Patchwork Sewing', 'https://images-na.ssl-images-amazon.com/images/I/71QUuWT%2BQLL._AC_SL1000_.jpg', ' Material: Fabric +Rayon, High Quality Acrylic Craft Felt\r\nPlease MIND the Size: 4 x 4 inches / 10cm * 10cm, (Mini size for your small projects)Thick: approx 1.0 mm / 0.04 inch\r\nColor: Assorted colors, 44 different colors, 1pc of each color. ', '6.48', 'Art and Crafts', 3),
(33, 'Easy-To-Do Crochet Kit', 'https://images-na.ssl-images-amazon.com/images/I/91bUBYtJvPL._AC_SL1500_.jpg', ' The Crochet Art Kit is a perfect beginner set to teach the fundamentals of crocheting.\r\nThe kit includes two (2) crochet hooks, one (1) plastic needle and seven (7) colors of yarn. ', '14.99', 'Art and Crafts', 3),
(34, 'Cricut Easy Press 2 - Heat Press Machine', 'https://images-na.ssl-images-amazon.com/images/I/61FuBG7gQhL._AC_SL1500_.jpg', ' 9 inches x 9 inches (22.5 inches x 22.5 inches) size ideal for basic t shirts, tote bags, pillows, aprons, and more\r\nProfessional iron on results in 60 seconds or less\r\nAdvanced heat plate design with ceramic coated surface ', '129.00', 'Art and Crafts', 4),
(35, 'Scissors, iBayam 8\" Multipurpose Scissors Bulk 3-Pack', 'https://images-na.ssl-images-amazon.com/images/I/61eT3wcT%2BKL._AC_SL1500_.jpg', 'Definitely household scissors -- Great for cutting burlap, paper, cardboard, light line, fabric, tape, photos. Perfect for sewing, tailoring, quilting, dressmaking, cutting patterns, alterations, hand craft. Exceptional scissors for multiple uses around the home, in the Handcraft Workshop', '9.99', 'Art and Crafts', 3),
(36, 'Image Arts Blue Christmas Wrapping Paper', 'https://images-na.ssl-images-amazon.com/images/I/818boUQftfL._AC_SL1500_.jpg', '120 SQUARE FEET: Each rool in this 4-pack of gift wrap measures 30 inches wide by 12 feet long for a total of 30 square feet per roll. 120 square feet total in the set.', '13.99', 'Art and Crafts', 1),
(37, 'Merry Christmas Banner - Vintage Xmas Decorations', 'https://images-na.ssl-images-amazon.com/images/I/714ZdXc9FuL._AC_SL1000_.jpg', ' MERRY CHRISTMAS is the delightfully festive eye-candy to brighten up your home, office or church.\r\nEach 5.8 x 5.8 inch paperboard card is distressed in brown for a unique and vintage look. ', '10.99', 'Art and Crafts', 2),
(38, 'Portable Car Vacuum Cleaner: High Power Corded Handheld', 'https://images-na.ssl-images-amazon.com/images/I/812Cu1m%2BApL._AC_SL1500_.jpg', ' KEEP YOUR CAR PROFESSIONAL LEVEL CLEAN! No more crumbs, dust or dirt! With our ThisWorx Portable Car Vacuum Cleaner you’ll be free of any wet or dry messes, even liquids, cigarette ashes or pet hair\r\nPOWERFUL YET TINY! Our handheld vacuum weighs only 2.4 lbs but has a high power, 106W & 8.8 amps motor and metal turbine for the ultimate suction power. The 16ft power cord connects to the car’s 12V lighter port, for maximum coverage ', '34.99', 'Automotive', 3),
(39, ' VicTsing (Upgraded Version) V5.0 Bluetooth FM Transmitter for Car, QC3.0 & LED', 'https://images-na.ssl-images-amazon.com/images/I/61PTr5GDdXL._AC_SL1280_.jpg', '♕【2 PORTS USB CAR CHARGER and QC3. 0 CHARGER】Support Charge 2 devices simultaneously with Bluetooth FM transmitter for car. One port is Quick Charge 3.0 port, Up to 4X faster than standard chargers, able to charge compatible devices to 80% in just 35 minutes, and the other USB charging port (5V/1A) also functions as a U disk port for play music.', '12.74', 'Automotive', 1),
(40, 'Bling Car Decor Crystal Rhinestone Car Bling Ring Emblem Sticker', 'https://images-na.ssl-images-amazon.com/images/I/51nGziF%2BiWL._AC_.jpg', 'Personalize Your Car - Glam up your ride with sparkly car decor accessories that reflect your personality. Classy, girly, bougie & cute, these crystal bling ring emblems will start up your day bright. ', '6.98', 'Automotive', 4),
(41, 'NOCO GENIUS1, 1-Amp Fully-Automatic Smart Charger, 6V And 12V Battery Charger', 'https://images-na.ssl-images-amazon.com/images/I/81Wd4nh6jEL._AC_SL1500_.jpg', 'Meet the GENIUS1 - Similar to our G750, just better. It\'s 35% smaller and delivers 35% more power. It\'s the all-in-one solution - battery charger, battery maintainer, trickle charger, plus battery desulfator. ', '29.50', 'Automotive', 5),
(42, 'Loctite Heavy Duty Threadlocker, 0.2 oz, Blue 242', 'https://images-na.ssl-images-amazon.com/images/I/910GUz2SiuL._AC_SL1500_.jpg', 'Compatible material 	Metal\r\nColor 	Blue\r\nBrand 	Henkel\r\nContainer type 	Tube\r\nFull cure time 	24 Hours\r\nAbout this item\r\n\r\n    Advanced formula prevents loosening of metal fasteners caused by vibrations\r\n    Protective design protects threads from rusting and corroding\r\n    Medium-strength allows nuts and bolts to be removed with hand tools\r\n    Locks and seals threaded fasteners that require disassembly\r\n', '5.97', 'Automotive', 2),
(43, 'Energizer Jumper Cables for Car Battery, Heavy Duty Automotive Booster Cables', 'https://images-na.ssl-images-amazon.com/images/I/71CntbPaoNL._AC_SL1494_.jpg', 'ENERGIZER 16 FEET JUMPER CABLES - 6 Gauge, 16 FT booster battery jumper cables for jump starting a dead or weak battery. Ideal for trucks, SUVs, full-size cars, mid-size cars and small/compact cars', '15.99', 'Automotive', 4),
(44, 'VacLife Air Compressor Tire Inflator, DC 12V Air Pump for Car Tires', 'https://images-na.ssl-images-amazon.com/images/I/61iffkFC6vL._AC_SL1000_.jpg', '[FAST INFLATING SPEED & EASY TO USE] This auto tire air compressor can inflate your standard car tire fastest in seconds. Simply plug it into the 12V power outlet in your car and attach the hose to the tire you wish to inflate. You can just flip the switch and the car air compressor will do all the work for you.If a converter is needed, it\'s recommended to use converter in accordance with 120 W, 10 A specification. ', '26.96', 'Automotive', 2),
(45, 'Garmin dezl 780 LMT-S, GPS Truck Navigator, 7\" Display', 'https://images-na.ssl-images-amazon.com/images/I/613GSrWfayL._AC_SL1000_.jpg', ' Premium 7” truck navigator with powered magnetic mount and includes map updates\r\nFree live services, such as traffic and weather, when you download the free Smartphone Link app on your compatible smartphone. Display size- 6.0 W x 3.5 H (15.2 x 8.9 cm); 6.95 Inch (17.7 cm) ', '349.98', 'Automotive', 5),
(46, 'Baby Diapers Size 4, 150 Count - Pampers Swaddlers, ONE MONTH SUPPLY', 'https://images-na.ssl-images-amazon.com/images/I/71GZ9GrEKzL._AC_SL1500_.jpg', ' Trusted protection, Pampers is the #1 U.S. Pediatrician Recommended Brand\r\nLockAway Channels absorb wetness and lock it away\r\nBreatheFree Liner helps soothe and protect baby\'s skin ', '49.93', 'Baby', 5),
(47, ' iPlay, iLearn 10pcs Baby Rattles Teether, Shaker, Grab and Spin Rattle', 'https://images-na.ssl-images-amazon.com/images/I/719I85%2B5r4L._AC_SL1500_.jpg', ' Holiday deals! 10 Bright Primary colored Rattles/Teethers for different stages of baby’s development.\r\nEach rattle has different grips, shapes and tasks to assist in fine motor skills. ', '20.35', 'Baby', 1),
(48, 'Playtex Diaper Genie Refill Bags, Ideal for Diaper Genie Diaper Pails, 270 Count ', 'https://images-na.ssl-images-amazon.com/images/I/91C0SDBkQYL._AC_SL1500_.jpg', ' Keep Your Nursery Smelling Fresh Playtex Diaper Genie 7 Layer Refills Protect Your Baby’s Nursery From Unwanted Odors and Germs\r\n7 Layers Strong Built Durable, the Diaper Pail Refill Bags Feature 7 Layers That Work Together to Help Lock in Diaper Odors and Secure Unwanted Messes ', '18.53', 'Baby', 3),
(49, 'Baby Einstein 4-in-1 Kickin\' Tunes Music and Language Discovery Activity Play Gym', 'https://images-na.ssl-images-amazon.com/images/I/81dKrcbHXcL._SL1500_.jpg', '    4 modes: Laying, Sitting, Tummy Time & Take-Along\r\n    70+ sounds & activities and 25+ minutes of music\r\n    Includes 7 detachable toys, including a Magic Touch piano, and 1 prop pillow\r\n    Mat is machine-washable; Easy to clean\r\n    Ships in fully enclosed packaging\r\n', '49.84', 'Baby', 4),
(50, 'Hudson Baby Unisex Baby Plush Animal Face Robe, Blue Elephant', 'https://images-na.ssl-images-amazon.com/images/I/810%2Bv4Lu2QL._SL1500_.jpg', '\r\n    100% Polyester\r\n    Imported\r\n    Animal face plush hooded bath robe\r\n    Made with 100% plush fleece fabric\r\n    Soft and gentle on baby\'s skin\r\n    Optimal for everyday use\r\n    Affordable, high quality bath robe\r\n', '9.99', 'Baby', 0),
(51, 'Mega Bloks First Builders Big Building Bag with Big Building Blocks', 'https://images-na.ssl-images-amazon.com/images/I/91WmmSl0YkL._AC_SL1500_.jpg', ' 80 classic-colored building blocks, including special shapes\r\nPerfect for little hands\r\nHands-on play for early childhood development\r\nStorage bag for easy cleanup\r\nCombine with other Mega Bloks preschool toys and build them up ', '14.90', 'Baby', 0),
(52, 'essence | Lash Princess False Lash Effect Mascara | Gluten & Cruelty Free', 'https://images-na.ssl-images-amazon.com/images/I/61nvmVTF12L._SL1500_.jpg', ' If you receive this mascara UNWRAPPED, it did not come from essence cosmetics.\r\nNO FALSIES NEEDED! Lash Princess False Lash Mascara defines and separates lashes while achieving a bold look.\r\nDRAMATIC VOLUME: the conic shape fiber brush delivers dramatic volume and sculpted length WITHOUT clumps or globs. ', '4.99', 'Beauty and Makeup', 0),
(53, 'Tree Hut Shea Sugar Scrub Tropical Mango', 'https://images-na.ssl-images-amazon.com/images/I/61OzSj4jB3L._SL1000_.jpg', ' 100% PURE NATURAL SHEA BUTTER - Premium deep moisturizer that wonderfully softens and smooths dry cracked skin.\r\nSAFFLOWER SEED OIL, AVACADO OIL, SWEET ALMOND OIL, MACADAMIA SEED OIL, ORANGE OIL - Amazing skin conditioners that prevents dryness and provides your skin a refined healthy glow. ', '5.99', 'Beauty and Makeup', 0),
(54, 'REVLON One-Step Hair Dryer And Volumizer Hot Air Brush, Black, Packaging May Vary', 'https://images-na.ssl-images-amazon.com/images/I/71aXzv34N%2BL._SL1500_.jpg', ' Delivers gorgeous volume and brilliant shine in a single step\r\nUnique oval brush design for smoothing the hair, while the round edges create volume. Designed with Nylon Pin & Tufted Bristles for detangling, improved volume and control. Unlike conventional hair dryers, this volumizer can be placed closer to the scalp for lift ', '41.88', 'Beauty and Makeup', 0),
(55, 'Foot Peel Mask 2 Pack, Peeling Away Calluses and Dead Skin Cells', 'https://images-na.ssl-images-amazon.com/images/I/61GV9fb2OAL._SL1242_.jpg', 'If you suffer from dry, cracked feet with callouses, then you want the best foot care treatment you can get that restores your feet to the smooth, soft feel you once had in as little as two weeks. If you’re unhappy with your purchase of our foot peel, we’ll provide you with a full refund. ', '27.95', 'Beauty and Makeup', 0),
(56, 'Wahl 5622 Groomsman Rechargeable Beard, Mustache', 'https://images-na.ssl-images-amazon.com/images/I/91-bMXekgVL._SL1500_.jpg', 'Stainless Steel Blades – Our high-carbon precision-ground blades stay sharp longer, use in conjunction with our six-position beard regulator for multiple face trimming lengths; our beard guards vary from stubble to short & clean, to thick & even ', '22.41', 'Beauty and Makeup', 0),
(57, 'MANSCAPED™ Electric Groin Hair Trimmer, The Lawn Mower™ 3.0', 'https://images-na.ssl-images-amazon.com/images/I/71eLlcJO5ML._AC_SL1500_.jpg', 'WHAT IS THE LAWN MOWER 3.0: Welcome to the newest and latest in below-the-waist trimming. The Lawn Mower 3.0 from MANSCAPED is the only trimmer you need to keep your manhood looking trim, neat, and clean. Soft ceramic blades featuring advanced SkinSafe Technology ensures confidence while trimming below-the-waist. ', '54.99', 'Beauty and Makeup', 0),
(58, 'SHAPERX Shapewear for Women Tummy Control Fajas Colombianas Body Shaper Zipper Open Bust Bodysuit', 'https://images-na.ssl-images-amazon.com/images/I/71Be1DiRXUL._AC_UY741_.jpg', 'LOOK SLIMMER & SEXIER: Fajas Colombian bodysuit shapewear is design to specially shape the midsection with targeted firm tummy control to emphasize your natural curves. High waist design reduces waistline creating a slimmer feminine silhouette.It’s designed to give you a smoother curve help you look great in dresses!If you are between two sizes,please purchase a small size.Such as your waist size between medium and large,you can choose medium size. ', '35.99', 'Women Fashion', 0),
(59, 'UGG Women\'s Mini Bailey Bow II Boot', 'https://images-na.ssl-images-amazon.com/images/I/71WgdOSrndL._AC_UX500_.jpg', '\r\n    Sheepskin, Cow Suede\r\n    Imported\r\n    Dyed Sheep, Fur Origin: United States/United Kingdom/Spain/Ireland/Australia\r\n    Synthetic sole\r\n    Shaft measures approximately 5.5\" from arch\r\n    Fully lined with fur. Nylon binding\r\n    Pretreated sheepskin that is water and stain resistant\r\n', '169.95', 'Women Fashion', 0),
(60, 'Sterling Silver Diamond 3 Stone Heart Pendant Necklace', 'https://images-na.ssl-images-amazon.com/images/I/71LF3vAwPPL._AC_UY535_.jpg', '\r\n    Sterling silver necklace featuring diamond-accented open heart pendant with hanging trio of diamonds at center\r\n    Rolo chain\r\n    The total diamond carat weight listed is approximate. Variances may be up to .03 carats.\r\n    All our diamond suppliers confirm that they comply with the Kimberley Process to ensure that their diamonds are conflict free.\r\n    Imported\r\n', '99.90', 'Women Fashion', 0),
(61, 'Anne Klein Women\'s Bracelet Watch', 'https://images-na.ssl-images-amazon.com/images/I/81xCpb%2BRC1L._AC_UL1500_.jpg', ' Mineral crystal lens; Green dial with rose gold-tone hands and Roman numerals; Printed outer and inner minute tracks\r\nRose gold-tone adjustable link bracelet; Jewelry clasp and extender\r\nJapanese-quartz movement\r\nCase diameter: 30 millimeter ', '27.99', 'Women Fashion', 0),
(62, ' Medium Shopping Bag ', 'https://images-na.ssl-images-amazon.com/images/I/61JuMynmpjL._AC_UY695_.jpg', '\r\n    Telfar’s iconic Unisex Shopping Bag is an Everyday bag for Everyone.\r\n    Features include: short handles for hand-carry and longer cross-body straps, embossed logo on front of bag, a main compartment with internal zipper pocket and magnetic snap closure.\r\n    Bag is made from faux leather with twill lining.\r\n    Packaged in a 100% cotton drawstring bag with screen-printed logo.\r\n    Dimensions: Height 10.75”, Width 15\", Depth 5\", Drop 21\"\r\n', '202.05', 'Women Fashion', 0),
(63, ' Champion Men\'s Graphic Powerblend Fleece Hoodie Script Sweatshirt ', 'https://images-na.ssl-images-amazon.com/images/I/81v5g7gRPPL._AC_UX569_.jpg', '\r\n    50% Cotton, 50% Polyester\r\n    Imported\r\n    Pull On closure\r\n    Machine Wash\r\n    Better fit. Wider rib cuffs and hem\r\n    Soft comfortable fabric. A percentage of recycled fibers used in making the fabric\r\n', '61.00', 'Men Fashion', 0),
(64, ' Nike Men\'s Air Force 1 \'07 Basketball Shoe ', 'https://images-na.ssl-images-amazon.com/images/I/81uiWMk9dnL._AC_UX500_.jpg', ' Nike Men\'s Air Force 1 \'07 Basketball Shoe ', '220.00', 'Men Fashion', 0),
(65, ' Bulova Mens Marine Star - 98B301 ', 'https://images-na.ssl-images-amazon.com/images/I/81io8OejSiL._AC_UX679_.jpg', '\r\n    Imported\r\n    Marine Star Chronograph\r\n    Mineral Domed\r\n    Analog-quartz Movement\r\n    Case Diameter: 45mm\r\n    Water resistant 200m (660ft): in general, suitable for professional marine activity and serious surface water sports, but not diving\r\n', '325.00', 'Men Fashion', 0),
(66, 'TRAVANDO Money Clip Wallet\"RIO\" - Mens Wallets slim Front Pocket', 'https://images-na.ssl-images-amazon.com/images/I/81dEqFb7ZGL._AC_UY741_.jpg', ' Leather lining\r\nNo Closure closure\r\n𝗙𝗨𝗡𝗖𝗧𝗜𝗢𝗡𝗔𝗟 & 𝗦𝗟𝗜𝗠 – Travando’s Wallet offers 7 card pockets. The slim wallet is ideal for carrying business cards, credit and debit cards, bills etc.. The outside notch allows you to push out the cards easily ', '29.95', 'Men Fashion', 0),
(67, ' Under Armour Boys\' Brawler Tapered Training Pants ', 'https://images-na.ssl-images-amazon.com/images/I/51XqprEhOHL._AC_UX679_.jpg', ' 100% Polyester\r\nImported\r\nDrawstring closure\r\nLightweight, Cold Weather Sweatpants: Made from 100% Polyester, these are perfect to wear around the house or to keep you warm in the cold ', '30.00', 'Men Fashion', 0),
(68, ' Cyberpunk 2077 - PlayStation 4 ', 'https://images-na.ssl-images-amazon.com/images/I/81iR0aGNJ5L._SL1500_.jpg', '\r\n    Cyberpunk 2077 is an open-world, action-adventure story set in Night City\r\n    Become a cyberpunk, an urban mercenary equipped with cybernetic enhancements and build your legend on the streets of Night City\r\n    Take the riskiest job of your life and go after a prototype implant that is the key to immortality\r\n', '49.94', 'Video Games', 0),
(69, 'Microsoft Xbox Wireless Controller + Wireless Adapter for Windows 10', 'https://images-na.ssl-images-amazon.com/images/I/61M3Bd9IBnL._AC_SL1200_.jpg', ' Experience the enhanced comfort and feel of the Xbox Wireless Controller\r\nStay on target with textured grip\r\nIncludes Bluetooth technology for gaming on Windows 10 PCs and tablets\r\nWireless adapter features a 66 percent smaller design, wireless stereo sound support, and the ability to connect upto eight controllers at once\r\nCompatible With Xbox One X, Xbox One S, Xbox One, Windows 10 ', '99.99', 'Video Games', 0),
(70, 'Redragon S101 Wired Gaming Keyboard and Mouse Combo RGB Backlit', 'https://images-na.ssl-images-amazon.com/images/I/71kr3WAj1FL._AC_SL1500_.jpg', 'PC GAMING KEYBOARD AND GAMING MOUSE COMBO: Includes Redragon RGB Backlit Computer Gaming Keyboard and RGB Backlit Gaming Mouse. ALL-IN-ONE PC GAMER VALUE KIT, Fantastic for Gamers (New Improved Version) ', '39.98', 'Video Games', 0),
(71, ' Nintendo 2DS - Electric Blue (Renewed) ', 'https://images-na.ssl-images-amazon.com/images/I/81kvl3W6X9L._SL1500_.jpg', 'This pre-owned product has been professionally inspected, tested and cleaned by Amazon-qualified suppliers.\r\n- There will be no visible cosmetic imperfections when held at an arm’s length.\r\n- Products with batteries will exceed 80% capacity relative to new.\r\n- Accessories may not be original, but will be compatible and fully functional. Product may come in generic', '139.78', 'Video Games', 0),
(72, 'Samsung Galaxy Tab A7 10.4 Wi-Fi 32GB Silver (SM-T500NZSAXAR)', 'https://images-na.ssl-images-amazon.com/images/I/71MvL2kCFCL._AC_SL1500_.jpg', 'SLIM, STYLISH DESIGN: Stream and browse on a 10.4-inch¹ ultra-widescreen display designed to bring your content to life without weighing you down. The front-facing, landscape-oriented camera allows you to transition between entertainment and video calls seamlessly. ', '229.99', 'Computers and Consoles', 0),
(73, 'Acer Predator Helios 300 Gaming Laptop, Intel i7-10750H', 'https://images-na.ssl-images-amazon.com/images/I/71k45hZkLmL._AC_SL1500_.jpg', ' 10th Generation Intel Core i7-10750H 6-Core Processor (Up to 5.0 GHz) with Windows 10 Home 64 Bit\r\nOverclockable NVIDIA GeForce RTX 2060 with 6 GB of dedicated GDDR6 VRAM\r\n15.6\" Full HD (1920 x 1080) Widescreen LED-backlit IPS display (144Hz Refresh Rate, 3ms Overdrive Response Time, 300nit Brightness & 72% NTSC)\r\n16 GB DDR4 2933MHz Dual-Channel Memory, 512GB NVMe SSD (2 x M.2 ', '1,178.12', 'Computers and Consoles', 0),
(74, 'Acer Aspire TC-895-UA92 Desktop, 10th Gen Intel Core i5-10400 6-Core Processor, 12GB 2666MHz', 'https://images-na.ssl-images-amazon.com/images/I/61A%2BK1MjTeL._AC_SL1500_.jpg', ' 10th Generation Intel Core i5-10400 6-Core Processor (Up to 4.3GHz)\r\n12GB 2666MHz DDR4 Memory | 512GB NVMe M.2 SSD | 8X DVD-Writer Double-Layer Drive (DVD-RW)\r\nIntel Wireless Wi-Fi 6 AX200 802.11ax Dual-Band 2.4GHz and 5GHz featuring 2x2 MU-MIMO technology | Bluetooth 5.1 | 10/100/1000 Gigabit Ethernet LAN ', '529.99', 'Computers and Consoles', 0),
(75, ' PlayStation 5 Console ', 'https://images-na.ssl-images-amazon.com/images/I/619BkvKW35L._SL1500_.jpg', '\r\n    Lightning Speed - Harness the power of a custom CPU, GPU, and SSD with Integrated I/O that rewrite the rules of what a PlayStation console can do.\r\n    Stunning Games - Marvel at incredible graphics and experience new PS5 features.\r\n    Breathtaking Immersion - Discover a deeper gaming experience with support for haptic feedback, adaptive triggers, and 3D Audio technology.\r\n', '729.99', 'Computers and Consoles', 0),
(76, 'Xbox One X 1TB Console - PLAYERUNKNOWN’S BATTLEGROUNDS Bundle', 'https://images-na.ssl-images-amazon.com/images/I/719WGHim%2BmL._SL1200_.jpg', ' Join the battle with the Xbox 1 X PLAYERUNKNOWN\'S BATTLEGROUNDS Bundle which includes a full game download of PLAYERUNKNOWN’S BATTLEGROUNDS enhanced for Xbox 1 X with support for 4K resolution and HDR\r\nDrop into a competitive survival battle and defeat every player on the map to be the last player left alive\r\nGames play better on Xbox 1 X: Experience 40 percent more power than any other console; 6 teraflops of graphical processing power and a 4K Blu ray player provide more immersive gaming and entertainment ', '425.00', 'Computers and Consoles', 0),
(77, 'Google Pixel 4a - New Unlocked Android Smartphone', 'https://images-na.ssl-images-amazon.com/images/I/71Q8gm97H8L._AC_SL1500_.jpg', ' New, unlocked Android phone gives you the flexibility to change carriers and choose your own data plan; works with Verizon, T-Mobile, Sprint, AT&T, and other major carriers\r\nCapture great photos using your cell phone on the 12 MP dual pixel rear camera with features like Live HDR+, Night Sight, and Portrait Mode; share photos directly from the viewfinder of your Pixel camera to Google and popular third party apps ', '499.00', 'Mobile Phones', 0),
(78, 'Samsung Galaxy A51 Factory Unlocked Cell Phone', 'https://images-na.ssl-images-amazon.com/images/I/516JYsC4a6L._AC_SL1024_.jpg', 'Long Lasting and Fast Charging Battery: This long-lasting 4000mAh battery2 retains power throughout the day, so you can keep streaming, snapping, and sharing. And if you’re short on time and juice, Fast Charging will have you back up and running in no time ', '399.99', 'Mobile Phones', 0),
(79, 'Moto G Stylus | Unlocked | Made for US by Motorola', 'https://images-na.ssl-images-amazon.com/images/I/71Swc5WsxrL._AC_SL1500_.jpg', 'Unlocked for the freedom to choose your carrier. Compatible with AT&T, Sprint, T-Mobile, and Verizon networks. Sim card not included. Customers may need to contact Sprint for activation on Sprint’s network. ', '199.99', 'Mobile Phones', 0),
(80, 'Nokia 5.3 Fully Unlocked Smartphone with 6.55\" HD+ Screen', 'https://images-na.ssl-images-amazon.com/images/I/31CGbfSTdeL._AC_.jpg', 'Go big with the Nokia 5.3 smartphone\'s epic-sized 6. 55-inch HD+ display and incredible quad rear camera that captures stunning pictures even in low light, helps you select your best shot, and creates professional-looking portraits. ', '189.99', 'Mobile Phones', 0),
(81, 'New Apple iPhone 12 (128GB, Black)', 'https://m.media-amazon.com/images/I/71fVoqRC0wL._FMwebp__.jpg', '    OFFER INCLUDES: An Apple iPhone and a wireless plan with unlimited data/talk/text\r\n    WIRELESS PLAN: Unlimited talk, text, and data with mobile hotspot, nationwide coverage, and international reach. No long-term contract required.\r\n    PROGRAM DETAILS: When you add this offer to cart, it will reflect 3 items: the iPhone, SIM kit, and carrier subscription\r\n    Ceramic Shield, tougher than any smartphone glass\r\n    A14 Bionic chip, the fastest chip ever in a smartphone', '699.99', 'Mobile Phones', 0),
(82, 'Apple iPhone 11, 64GB, Black - Fully Unlocked (Renewed)', 'https://images-na.ssl-images-amazon.com/images/I/61gYe3YaoxL._AC_SL1500_.jpg', 'This pre-owned product is not Apple certified, but has been professionally inspected, tested and cleaned by Amazon-qualified suppliers.\r\n- There will be no visible cosmetic imperfections when held at an arm’s length.\r\n- This product will have a battery which exceeds 80% capacity relative to new.\r\n- Accessories may not be original, but will be compatible and fully functional. Product may come in generic Box.', '599.99', 'Mobile Phones', 0),
(83, 'Apple iPhone XS, 256GB , Space Gray - Fully Unlocked (Renewed)', 'https://images-na.ssl-images-amazon.com/images/I/71XeQzRDyML._AC_SL1500_.jpg', ' Fully unlocked and compatible with any carrier of choice (e.g. AT&T, T-Mobile, Sprint, Verizon, US-Cellular, Cricket, Metro, etc.).\r\nThe device does not come with headphones or a SIM card. It does include a charger and charging cable that may be generic, in which case it will be UL or Mfi (Made for iPhone) Certified. ', '529.00', 'Mobile Phones', 0),
(84, 'Apple iPhone 8 Plus, GSM Unlocked, 64GB - Gold (Renewed)', 'https://images-na.ssl-images-amazon.com/images/I/51m095zShrL._AC_SL1183_.jpg', ' Locked to the GSM network and only compatible with GSM carriers like AT&T, T-Mobile and Metro. Will not work with Sprint, Verizon, US Cellular or Cricket.\r\nThe device does not come with headphones or a SIM card. It does include a charger and charging cable that may be generic, in which case it will be UL or Mfi (Made for iPhone) Certified. ', '338.99', 'Mobile Phones', 0),
(85, 'OnePlus 8 Pro Onyx Black,​ 5G Unlocked Android Smartphone U.S Version', 'https://images-na.ssl-images-amazon.com/images/I/51az5uPx4AL._AC_SL1040_.jpg', ' 120 Hz Fluid Display – Watch your favorite shows and movies on a state-of-the-art 6.78\" QHD+ display with brilliant color accuracy and a seamless 120 Hz refresh rate.\r\n5G Capable – Experience faster upload and download speeds along with lower latency when connected to a 5G network. ', '799.00', 'Mobile Phones', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `joined` datetime NOT NULL,
  `group_id` int(11) NOT NULL,
  `credits` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `salt`, `name`, `joined`, `group_id`, `credits`) VALUES
(17, 'escgamingt.o@gmail.com', 'c36dd16d2fbca1d07cba99528f600bc2ffccb30912396b447da18dc36a7b1f30', 'e88005d9f8b25d182f96ce11170e7f35', 'Steffen', '2020-12-04 17:16:54', 2, '99988143.77'),
(41, 'dev1@gmail.com', 'd2e4faa9bae5cb890e91630627d925247eba1573f6491407a13579b97624f7b7', 'fb1c7b5e2b1d4bf057f51a8624117708', 'Test', '2020-12-06 20:45:26', 1, '1771.12'),
(42, 'dev2@gmail.com', 'e725a5cb1bd642f454f1157fa2e972f32796f38e2610d92ae74806b0fea7457f', 'e0a6743c8bb8d5d946ce26d6c2d26375', 'Test', '2020-12-06 20:45:33', 1, '50'),
(43, 'dev3@gmail.com', '46074bb1db82920f3b7dc87b1b125073ff1842b4d922ccc527b9ba4e2b6b9cbd', 'd19a39d27c0d95351b60c0fda98d1cd3', 'Test', '2020-12-06 21:04:51', 1, '50');

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_session`
--

INSERT INTO `users_session` (`id`, `user_id`, `hash`) VALUES
(15, 17, '74c817a4483cf70465e239dbcd5dcd54a81f3178b2123b09cc2ff1e1f364255c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
