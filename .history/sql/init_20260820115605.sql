-- =============================================================
-- ZOEM Kinder & Dagverblijf - demo database
-- =============================================================
USE zoemkinderopvang;

CREATE TABLE IF NOT EXISTS settings (key_name VARCHAR(100) PRIMARY KEY, value TEXT) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO settings (key_name, value) VALUES
('site_name','ZOEM Kinderopvang'),('tagline','Spelen, ontdekken en groeien in een natuurlijke omgeving.'),
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
 'Een warme peuterspeelzaal voor peuters van 0 tot 4 jaar. In een blije en veilige omgeving spelen, ontdekken en groeien kinderen samen.',
 'Een warme peuterspeelzaal van 0 tot 4 jaar.','icon-bee',1),
('bso','BSO','De Kraanvogels',
 'Buitenschoolse opvang voor kinderen van 4 tot 12 jaar. Na school lekker buiten spelen, samen ontdekken en genieten.',
 'Buitenschoolse opvang voor kinderen van 4 tot 12 jaar.','icon-bird',2);

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
(1,'Peuterspeelzaal dagcontract',NULL,42.50,'0-4 jaar','Inclusief drinken, vers fruit en een warme lunch.',1),
(1,'Peuterspeelzaal particulier',5.75,NULL,'0-4 jaar','Per uur bij losse opvangdagen.',2),
(2,'BSO dagcontract',NULL,39.50,'4-12 jaar','Inclusief tussendoortje en vers fruit.',1),
(2,'BSO particulier',5.25,NULL,'4-12 jaar','Per uur bij losse opvangdagen.',2);

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
('Zohal','Pedagogisch medewerker','Altijd met een warme blik voor elk kind. Een zeer betrokken en professionele opvoedster.','Pedagogisch medewerkster',1),
('Merel','Pedagogisch medewerker','Een energieke, vrolijke persoonlijkheid met een stralende glimlach. De kinderen genieten van haar liefdevolle zorg.','Pedagogisch medewerkster',2),
('Lotte','Coördinator','Zorgt voor de dagelijkse gang van zaken en een warm welkom.','Coördinator opvang',3);
CREATE TABLE IF NOT EXISTS reviews (
  id INT AUTO_INCREMENT PRIMARY KEY, customer_name VARCHAR(150) NOT NULL, child_age VARCHAR(50) DEFAULT '',
  rating TINYINT NOT NULL DEFAULT 5, comment TEXT NOT NULL, service_used VARCHAR(100) DEFAULT '',
  approved TINYINT(1) DEFAULT 0, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO reviews (customer_name, child_age, rating, comment, service_used, approved) VALUES
('Moeder van Khaled (4) en Taïm (6)','4 en 6',5,
 'Merel is altijd een geweldige, vriendelijke en zorgzame begeleidster voor onze kinderen. Ze glimlacht veel en heeft groot geduld. De kinderen hebben de opvang leren liefhebben en voelden zich altijd veilig.','Peuterspeelzaal',1),
('Vader en moeder van Hazel (2)','2',5,
 'Zohal heeft onze oudste dochter het eerste jaar begeleid. Een sterke band, en ze voelde zich erg veilig. We zouden het iedereen aanraden.','Peuterspeelzaal',1),
('Moeder van Julian (2,5)','2.5',5,
 'Lief, warm en heel professioneel. Ze kijken echt naar wat elk kind nodig heeft. Het belangrijkste: onze jongen had er ontzettend veel plezier.','Peuterspeelzaal',1),
('Vader van Ilsa (9) en Jolijn (9)','9 en 9',5,
 'De kinderen omschrijven Merel als een vrolijke, actieve begeleidster. Altijd een leuke dag, en ze neemt de tijd voor de ouders.','BSO',1),
('Vader en moeder van Ava (4)','4',5,
 'Betrokken en kundig. Ze verwelkomt ieder kind met een knuffel en veel geduld.','BSO',1);

CREATE TABLE IF NOT EXISTS photos (
  id INT AUTO_INCREMENT PRIMARY KEY, caption VARCHAR(200) DEFAULT '', image_url VARCHAR(255) NOT NULL,
  category VARCHAR(60) DEFAULT 'algemeen', active TINYINT(1) DEFAULT 1, sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO photos (caption, image_url, category, sort_order) VALUES
('Buiten spelen in de natuur','https://images.unsplash.com/photo-1544005313-94ddf0286196?w=800&auto=format&fit=crop&q=80','spelen',1),
('Knutselen en creatief bezig zijn','https://images.unsplash.com/photo-1577962023344-d2432b6a98e6?w=800&auto=format&fit=crop&q=80','activiteit',2),
('Samen gezond eten','https://images.unsplash.com/photo-1466611653911-95081537e5b0?w=800&auto=format&fit=crop&q=80','voeding',3),
('Lekker bewegen','https://images.unsplash.com/photo-1540343826482-928649394302?w=800&auto=format&fit=crop&q=80','activiteit',4),
('Gezellig samen in de groep','https://images.unsplash.com/photo-1577863645843-d918d4810e3c?w=800&auto=format&fit=crop&q=80','groepsleven',5),
('Onze moestuin','https://images.unsplash.com/photo-1446826549830-81d54a4e8ab9?w=800&auto=format&fit=crop&q=80','natuur',6);

CREATE TABLE IF NOT EXISTS faqs (
  id INT AUTO_INCREMENT PRIMARY KEY, question VARCHAR(255) NOT NULL, answer TEXT NOT NULL,
  category VARCHAR(80) DEFAULT 'algemeen', active TINYINT(1) DEFAULT 1, sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO faqs (question, answer, sort_order) VALUES
('Hoe lang is de wachtlijst?','De wachttijd verschilt per locatie en opvangsoort. Neem contact met ons op voor de actuele status.','1'),
('Wat kost een opvangplek?','De tarieven verschillen. Gebruik onze rekentool om de netto maandkosten voor uw situatie te zien.','2'),
('Wat is kinderopvangtoeslag?','Dit is een financiële bijdrage van de overheid die ouders kunnen aanvragen voor kinderen tot 4 jaar (of tot 12 jaar voor BSO).','3'),
('Moet ik zelf eten meegeven?','Nee, wij verzorgen een warme, gezonde maaltijd inclusief vers fruit.','4'),
('Kan ik een rondleiding krijgen?','Ja, boek een gratis kennismakingsrondleiding. U bent van harte welkom.','5'),
('Wat zijn de openingstijden?','Peuterspeelzaal dagelijks 8:30-12:30, BSO dagelijks 7:30-18:00.','6');
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
('Feest voor onze nieuwe speeltuin','feestbeleid','Vandaag vierden we samen de opening van onze nieuwe buitenspeeltuin! De kinderen verwelkomden iedereen met een lied en taart.','Feest voor onze nieuwe speeltuin.','2025-03-15',1),
('Alles over kinderopvangtoeslag','kinderopvang','Nuttige informatie voor ouders die opvang- en voorschoolkosten delen.','Alles over kinderopvangtoeslag en het aanvragen ervan.','2025-02-01',2),
('Herfstplezier in de tuin','herfst','Lekker warm en droog blijven deze herfst; ook in de regen spelen we buiten.','Herfstplezier in de tuin.','2025-01-20',3);

CREATE TABLE IF NOT EXISTS day_program (
  id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(150) NOT NULL, age_group VARCHAR(80) NOT NULL,
  day_of_week TINYINT NOT NULL, start_time TIME NOT NULL, end_time TIME NOT NULL,
  description TEXT, icon VARCHAR(40) DEFAULT '', active TINYINT(1) DEFAULT 1, sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO day_program (title, age_group, day_of_week, start_time, end_time, description, sort_order) VALUES
('Welkom & fruit eten','0-4',1,'08:30:00','09:15:00','We verwelkomen de kinderen en eten samen vers fruit.',1),
('Buiten spelen','0-4',1,'09:15:00','10:00:00','Rennen, klimmen en de tuin ontdekken.',2),
('Knutselen','0-4',1,'10:00:00','10:45:00','Knutselen en creatief spelen.',3),
('Warme lunch','0-4',1,'10:45:00','11:15:00','Een warme en gezonde maaltijd.',4),
('Naschoolse opvang','4-12',2,'17:00:00','17:30:00','Tussendoortje en het delen van de dag.',1),
('Bewegen en spelen','4-12',2,'17:30:00','18:00:00','Sport, spel en buiten plezier.',2);

CREATE TABLE IF NOT EXISTS pedagogy (
  id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(150) NOT NULL, description TEXT,
  icon VARCHAR(40) DEFAULT '', sort_order INT DEFAULT 0, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO pedagogy (title, description, sort_order) VALUES
('Spelen is leren','Spelen is voor een kind de belangrijkste manier van leren. Wij bouwen daarop voort en laten kinderen de leiding nemen.','1'),
('Beweging & natuur','Dagelijks buiten en in beweging -- gezonde gewoontes van jongs af aan.','2'),
('Gezonde voeding','Wij koken warme, evenwichtige, biologische maaltijden en leren kinderen gezond eten.','3'),
('Geborgenheid & vrijheid','Vertrouwen, ritme en ruimte om zichzelf te zijn laten kinderen zelfverzekerd opgroeien.','4');
