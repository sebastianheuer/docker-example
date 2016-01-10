CREATE TABLE iF NOT EXISTS meetups (
  identifier VARCHAR(64) UNIQUE PRIMARY KEY,
  title VARCHAR(255),
  date DATETIME,
  capacity TINYINT
);

CREATE TABLE iF NOT EXISTS members (
  identifier VARCHAR(64) UNIQUE PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255)
);

CREATE TABLE iF NOT EXISTS rsvps (
  meetup_identifier VARCHAR(64),
  member_identifier VARCHAR(64),
  rsvp VARCHAR(20),
  UNIQUE KEY member_rsvp (meetup_identifier, member_identifier)
);

-- DEMO DATA

INSERT INTO `meetups` (`identifier`, `title`, `date`, `capacity`)
VALUES
  ('36a19a62a19a3fd7ce938e93ed2e838fb4a198c1', 'Some Other Meetup', '2016-02-14 17:30:00', 50),
  ('53f4c09ca309b708601d1ad6f73da9cea4a2ed78', 'Some Meetup', '2016-01-12 17:30:00', 70);

INSERT INTO `members` (`identifier`, `name`, `email`)
VALUES
  ('5a221c9b80c92024e24cef40efbf56cb27dffa53', 'John Doe', 'john@example.com');
