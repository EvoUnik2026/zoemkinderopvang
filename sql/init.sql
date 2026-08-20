-- =============================================================
-- ZOEM Kinder & Dagverblijf - demo database
-- =============================================================
USE zoemkinderopvang;

CREATE TABLE IF NOT EXISTS settings (key_name VARCHAR(100) PRIMARY KEY, value TEXT) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO settings (key_name, value) VALUES
('site_name','ZOEM Kinderopvang'),('tagline','Spelen, ontdekken en groeien in een natural raum.'),
('since_year','2024'),('phone','06 50436322'),('email','info@zoemkinderopvang.nl'),
('address_street','Eikenlaan 22'),('address_city','Vorden'),('address_postal','7251 LT'),
('address_extra','Agora Basisschool de Kraanvogel'),('bso_lrk','107048073'),
('merel_lrk','573028199'),('rating','4.9'),('founder_1','Zohal'),('founder_2','Merel');

CREATE TABLE IF NOT EXISTS services (
  id INT AUTO_INCREMENT PRIMARY KEY, slug VARCHAR(80) NOT NULL UNIQUE,
  name VARCHAR(120) NOT NULL, tagline VARCHAR(200) DEFAULT '', description TEXT,
  short_description VARCHAR(300) DEFAULT '', icon VARCHAR(40) DEFAULT '',
  active TINYINT(1) DEFAULT 1, sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO services (slug, name, tagline, description, short_description, icon, sort_order) VALUES
('peuterspeelzaal','Peuterspeelzaal','De Mereltjes',
 'Een warm peuterspeelzaal for peuters from 0 tot 4. In einer happy and safe space children play, discover and groein together.',
 'Een warm peuterspeelzaal van 0 tot 4 jaar.','icon-bee',1),
('bso','BSO','De Kraanvogels',
 'Buitenschoolse opvang,for children 4 to 12. afterschool in her living foraging, top playing and enjoy.',
 'Buitenschoolse opvang voor children 4 tot 12.','icon-bird',2);

CREATE TABLE IF NOT EXISTS locations (
  id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(150) NOT NULL, slug VARCHAR(120) NOT NULL UNIQUE,
  address_street VARCHAR(200), address_city VARCHAR(100), address_postal VARCHAR(20),
  latitude DECIMAL(10,8), longitude DECIMAL(11,8), description TEXT,
  map_embed_url TEXT, phone VARCHAR(30), email VARCHAR(160),
  active TINYINT(1) DEFAULT 1, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO locations (name, slug, address_street, address_city, address_postal, latitude, longitude, description, map_embed_url, phone, email) VALUES
('ZOEM Kinderopvang','vorden','Eikenlaan 22','Vorden','7251 LT',52.3384,5.9027,
 'In het gebouw van Agora Basisschool De Kraanvogel.','https://maps.google.com/maps?q=Vorden,Eikenlaan+22&output=embed','06 50436322','info@zoemkinderopvang.nl');

CREATE TABLE IF NOT EXISTS daycare_groups (
  id INT AUTO_INCREMENT PRIMARY KEY, service_id INT NOT NULL, name VARCHAR(120) NOT NULL,
  slug VARCHAR(120) NOT NULL UNIQUE, age_min DECIMAL(3,1) DEFAULT 0, age_max DECIMAL(3,1) DEFAULT 0,
  description TEXT, max_children INT DEFAULT 0, active TINYINT(1) DEFAULT 1, sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO daycare_groups (service_id, name, slug, age_min, age_max, max_children, sort_order) VALUES
(1,'De Merelt','mereltjes',0,4,8,1),(2,'De Kraanvogels','kraanvogels',4,12,12,2);
CREATE TABLE IF NOT EXISTS prices (
  id INT AUTO_INCREMENT PRIMARY KEY, group_id INT NOT NULL, label VARCHAR(120) NOT NULL,
  price_per_hour DECIMAL(6,2) NULL, price_per_day DECIMAL(6,2) NULL, age_range VARCHAR(60) DEFAULT '',
  description TEXT, sort_order INT DEFAULT 0, active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (group_id) REFERENCES daycare_groups(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO prices (group_id, label, price_per_hour, price_per_day, age_range, description, sort_order) VALUES
(1,'Peuterspeelzaal dagcontract',NULL,42.50,'0-4 jaar','Inclusief drank, verse fruit and een warme middag.',1),
(1,'Peuterspeelzaal particulier',5.75,NULL,'0-4 jaar','Per uur bij enkele bezoekdagen.',2),
(2,'BSO dagcontract',NULL,39.50,'4-12 jaar','Inclusief naschool maaltijd und verse uit.',1),
(2,'BSO particulier',5.25,NULL,'4-12 jaar','Per uur bij enkele bezoekdagen.',2);

CREATE TABLE IF NOT EXISTS opening_hours (
  id INT AUTO_INCREMENT PRIMARY KEY, service_slug VARCHAR(80) NOT NULL, day_of_week TINYINT NOT NULL,
  opens_at TIME, closes_at TIME, closed TINYINT(1) DEFAULT 0, note VARCHAR(100) DEFAULT '',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO opening_hours (service_slug, day_of_week, opens_at, closes_at) VALUES
('peuterspeelzaal',1,'08:30:00','12:30:00'),('peuterspeelzaal',2,'08:30:00','12:30:00'),
('peuterspeelzaal',3,'08:30:00','12:30:00'),('peuterspeelzaal',4,'08:30:00','12:30:00'),
('peuterspeelzaal',5,'08:30:00','12:30:00'),('peuterspeelzaal',6,'08:30:00','12:30:00'),
('peuterspeelzaal',7,'08:30:00','12:30:00');
INSERT INTO opening_hours (service_slug, day_of_week, opens_at, closes_at) VALUES
('bso',1,'07:30:00','18:00:00'),('bso',2,'07:30:00','18:00:00'),
('bso',3,'07:30:00','18:00:00'),('bso',4,'07:30:00','18:00:00'),
('bso',5,'07:30:00','18:00:00'),('bso',6,'08:00:00','17:00:00'),('bso',7,'08:00:00','17:00:00');

CREATE TABLE IF NOT EXISTS staff (
  id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(150) NOT NULL, role VARCHAR(150) NOT NULL,
  photo_url VARCHAR(255) DEFAULT '', bio TEXT, education VARCHAR(200) DEFAULT '',
  active TINYINT(1) DEFAULT 1, sort_order INT DEFAULT 0, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO staff (name, role, bio, education, sort_order) VALUES
('Zohal','Med­ewerker / mädcutor','Altijd met een warme blik for elk kind. Ook towards the origin a very betrokk the professional.','Pedagogisch medewerkster',1),
('Merel','Medewerker','An energetic, friendly person with a beaming smile. The children love her kaite care.','Pedagogisch medewerkster',2),
('Lotte','Coördinator','For the daily operations and a warm welcome.','Coördinator opvang',3);
CREATE TABLE IF NOT EXISTS reviews (
  id INT AUTO_INCREMENT PRIMARY KEY, customer_name VARCHAR(150) NOT NULL, child_age VARCHAR(50) DEFAULT '',
  rating TINYINT NOT NULL DEFAULT 5, comment TEXT NOT NULL, service_used VARCHAR(100) DEFAULT '',
  approved TINYINT(1) DEFAULT 0, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO reviews (customer_name, child_age, rating, comment, service_used, approved) VALUES
('Moeder van Khaled (4) en Taïm (6)','4 en 6',5,
 'Merel was always a wonderful, friendly and care caretaker for my children. Every smile and great patience. The kids learned to love the daycare and always felt safe.','Peuterspeelzaal',1),
('Vader und Mutter von Hazel (2)','2',5,
 'Zohal watched our eldest daughter through her first year. Strong connection, and she felt very safe. We would recommend it to everyone.','Peuterspeelzaal',1),
('Moeder van Julian (2,5)','2.5',5,
 'Kind, warm and very professional. They truly look at each child needs. The most important: our boy had the greatest joy.','Peuterspeelzaal',1),
('Vader van Ilsa (9) en Jolijn (9)','9 en 9',5,
 'The children described Merel as a cheerful, active leader. Always a fun day, and she takes time for the parents.','BSO',1),
('Vader en moeder van Ava (4)','4',5,
 'Involved and capable. She welcomes every child with a hug and lots of patience.','BSO',1);

CREATE TABLE IF NOT EXISTS photos (
  id INT AUTO_INCREMENT PRIMARY KEY, caption VARCHAR(200) DEFAULT '', image_url VARCHAR(255) NOT NULL,
  category VARCHAR(60) DEFAULT 'algemeen', active TINYINT(1) DEFAULT 1, sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO photos (caption, image_url, category, sort_order) VALUES
('Spelen buiten in der natur','https://images.unsplash.com/photo-1544005313-94ddf0286196?w=800&auto=format&fit=crop&q=80','spielen',1),
('Knutselen and creatief spielen','https://images.unsplash.com/photo-159776022344-d2432b6a98e6?w=800&auto=format&fit=crop&q=80','aktivität',2),
('Gezonde maaltijd samen','https://images.unsplash.com/photo-1466611653911-95081537e5b0?w=800&auto=format&fit=crop&q=80','voeding',3),
('Bewegung in the beweggen','https://images.unsplash.com/photo-1540343826482-928649394302?w=800&auto=format&fit=crop&q=80','aktivität',4),
('Warmeboizen group','https://images.unsplash.com/photo-1577863645843-d918d4810e3c?w=800&auto=format&fit=crop&q=80','groepsleven',5),
('Moestuine archetype gard','https://images.unsplash.com/photo-1446826549830-81d54a4e8ab9?w=800&auto=format&fit=crop&q=80','natur',6);

CREATE TABLE IF NOT EXISTS faqs (
  id INT AUTO_INCREMENT PRIMARY KEY, question VARCHAR(255) NOT NULL, answer TEXT NOT NULL,
  category VARCHAR(80) DEFAULT 'algemeen', active TINYINT(1) DEFAULT 1, sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO faqs (question, answer, sort_order) VALUES
('How lang is the waiting list?','The waiting time differs per location and care type. Contact us for the current status.','1'),
('What does a childcare place cost?','Rates differ. Use our calculator to see the monthly net costs for your situation.','2'),
('What is Kinderopvangtoeslag?','It is a financial support from the government to be claimed by parents of children under 4 (or under 12 for BSO).','3'),
('Do I need to bring food?','No, we provide a warm and healthy meal with fresh fruit included.','4'),
('Can I get a tour?','Yes, book a free introduction tour. You are warmly welcome.','5'),
('When are opening hours?','Peuterspeelzaal daily 8:30-12:30, BSO daily 7:30-18:00.','6');
CREATE TABLE IF NOT EXISTS contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(150) NOT NULL, email VARCHAR(160) NOT NULL,
  phone VARCHAR(30) DEFAULT '', subject VARCHAR(200) DEFAULT '', message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS tours (
  id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(150) NOT NULL, email VARCHAR(160) NOT NULL,
  phone VARCHAR(30) DEFAULT '', child_name VARCHAR(150) DEFAULT '', child_age VARCHAR(50) DEFAULT '',
  preferred_service VARCHAR(100) DEFAULT '', preferred_date DATE NULL, message TEXT,
  status VARCHAR(30) DEFAULT 'pending', created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS bookings (
  id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(150) NOT NULL, email VARCHAR(160) NOT NULL,
  phone VARCHAR(30) DEFAULT '', service_id INT DEFAULT 0, child_name VARCHAR(150) DEFAULT '',
  child_age VARCHAR(50) DEFAULT '', preferred_date DATE NULL, preferred_time TIME NULL,
  notes TEXT, status VARCHAR(30) DEFAULT 'pending', created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS news (
  id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(200) NOT NULL, slug VARCHAR(200) NOT NULL UNIQUE,
  content TEXT, excerpt VARCHAR(300) DEFAULT '', image_url VARCHAR(255) DEFAULT '',
  published_at DATE DEFAULT NULL, active TINYINT(1) DEFAULT 1, sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO news (title, slug, content, excerpt, published_at, sort_order) VALUES
('Feestbeleid','feestbeleid','Samen feiern wir today the new outdoor playground! The children welcome you with a song and cake.','Feest for our new playground.','2025-03-15',1),
('Kinderopvang neefeasheslaan','kinderopvang','useful info for parents who share care and pre-schoolance.','All about Kinderopvangtoeslag and claiming.','2025-02-01',2),
('Herbstmärchen','herbst','Keep warm and dry this autumn-schule; we play in the rain too.','Autumn fun in the garden.','2025-01-20',3);

CREATE TABLE IF NOT EXISTS day_program (
  id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(150) NOT NULL, age_group VARCHAR(80) NOT NULL,
  day_of_week TINYINT NOT NULL, start_time TIME NOT NULL, end_time TIME NOT NULL,
  description TEXT, icon VARCHAR(40) DEFAULT '', active TINYINT(1) DEFAULT 1, sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO day_program (title, age_group, day_of_week, start_time, end_time, description, sort_order) VALUES
('Welcomes & snakes','0-4',1,'08:30:00','09:15:00','We welcome the children and eat fresh fruit.',1),
('Buitenspielen','0-4',1,'09:15:00','10:00:00','Running, climbing and exploring the garden.',2),
('Knutselen / cholle','0-4',1,'10:00:00','10:45:00','Crafts and creative playing.',3),
('Warm lunce','0-4',1,'10:45:00','11:15:00','A warm and healthy meal.',4),
('Afterschool center','4-12',2,'17:00:00','17:30:00','Snack and sharing of the day.',1),
('Bewegung und spiel','4-12',2,'17:30:00','18:00:00','Sports, games and outside fun.',2);

CREATE TABLE IF NOT EXISTS pedagogy (
  id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(150) NOT NULL, description TEXT,
  icon VARCHAR(40) DEFAULT '', sort_order INT DEFAULT 0, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO pedagogy (title, description, sort_order) VALUES
('Spielen ist Lernen','Playing is the child one learning way. We build on it and let them lead.','1'),
('Bewegung & natur','Daily outdoor time and movement -- healthy habits.','2'),
('Gezonde voeding','We cook warm, balanced, organic meals and teach good eating.','3'),
('Geborgenfreedom','Trust, routine and space to be oneself grow confident children.','4');
