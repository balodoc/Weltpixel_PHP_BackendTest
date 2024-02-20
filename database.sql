CREATE TABLE IF NOT EXISTS `database` (
`OrderID` INT NULL,
`FirstName` VARCHAR(MAX) NULL,
`LastName` VARCHAR(MAX) NULL,
`OrderEmail` VARCHAR(MAX) NULL,
`OrderDate` VARCHAR(MAX) NULL,
`OrderItems.Item.all.ItemID` INT NULL,
`OrderItems.Item.all.ItemStatus` VARCHAR(MAX) NULL,
`OrderItems.Item.all.ItemStatusId` INT NULL,
`OrderItems.Item.all.ItemPrice` FLOAT NULL,
`OrderItems.Item.ItemID` INT NULL,
`OrderItems.Item.ItemStatus` VARCHAR(MAX) NULL,
`OrderItems.Item.ItemStatusId` INT NULL,
`OrderItems.Item.ItemPrice` FLOAT NULL
);

INSERT INTO database VALUES
(1,'Weltpixel','Ai','test@aol.com','2018-03-15T10:44:50',10,'Ordered',4,49.9700,NULL,NULL,NULL,NULL),
(1,'Weltpixel','Ai','test@aol.com','2018-03-15T10:44:50',20,'Cancelled',29,100.7000,NULL,NULL,NULL,NULL),
(1,'Weltpixel','Ai','test@aol.com','2018-03-15T10:44:50',30,'Item Shipped - Tracking Sent',17,21.0000,NULL,NULL,NULL,NULL),
(1,'Weltpixel','Ai','test@aol.com','2018-03-15T10:44:50',40,'Item Return Received',24,12.2000,NULL,NULL,NULL,NULL),
(1,'Weltpixel','Ai','test@aol.com','2018-03-15T10:44:50',50,'Item Shipped - Tracking Sent',17,15.9900,NULL,NULL,NULL,NULL),
(2,'Random','Name','test@aol.com','2018-03-15T10:44:50',30,'Item Shipped - Tracking Sent',17,21.0000,NULL,NULL,NULL,NULL),
(2,'Random','Name','test@aol.com','2018-03-15T10:44:50',40,'Item Return Received',24,12.2000,NULL,NULL,NULL,NULL),
(2,'Random','Name','test@aol.com','2018-03-15T10:44:50',50,'Item Shipped - Tracking Sent',17,15.9900,NULL,NULL,NULL,NULL),
(3,'Weltpixel','Ai','test@aol.com','2018-03-15T10:44:50',NULL,NULL,NULL,NULL,15,'Item Shipped - Tracking Sent',17,49.9700);