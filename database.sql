CREATE TABLE IF NOT EXISTS `order_item` (
`OrderID` INT NULL,
`FirstName` VARCHAR(255) NULL,
`LastName` VARCHAR(255) NULL,
`OrderEmail` VARCHAR(255) NULL,
`OrderDate` VARCHAR(255) NULL,
`OrderItems_Item_ItemID` INT NULL,
`OrderItems_Item_ItemStatus` VARCHAR(255) NULL,
`OrderItems_Item_ItemStatusId` INT NULL,
`OrderItems_Item_ItemPrice` FLOAT NULL
);

INSERT INTO order_item VALUES
(1,'Weltpixel','Ai','test@aol.com','2018-03-15T10:44:50',10,'Ordered',4,49.9700),
(1,'Weltpixel','Ai','test@aol.com','2018-03-15T10:44:50',20,'Cancelled',29,100.7000),
(1,'Weltpixel','Ai','test@aol.com','2018-03-15T10:44:50',30,'Item Shipped - Tracking Sent',17,21.0000),
(1,'Weltpixel','Ai','test@aol.com','2018-03-15T10:44:50',40,'Item Return Received',24,12.2000),
(1,'Weltpixel','Ai','test@aol.com','2018-03-15T10:44:50',50,'Item Shipped - Tracking Sent',17,15.9900),
(2,'Random','Name','test@aol.com','2018-03-15T10:44:50',30,'Item Shipped - Tracking Sent',17,21.0000),
(2,'Random','Name','test@aol.com','2018-03-15T10:44:50',40,'Item Return Received',24,12.2000),
(2,'Random','Name','test@aol.com','2018-03-15T10:44:50',50,'Item Shipped - Tracking Sent',17,15.9900),
(3,'Weltpixel','Ai','test@aol.com','2018-03-15T10:44:50',15,'Item Shipped - Tracking Sent',17,49.9700);