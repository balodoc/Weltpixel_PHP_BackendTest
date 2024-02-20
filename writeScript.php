<?php
/**
 * 1. Get all orders from the database that are from Weltpixel
 * Hint: Utilize the Database implementation to connect and retrieve data;
 *
 * 2. Send an email notification to the OrderEmail field for the items with status Item Shipped that includes a total amount and the order details(name, date, item id, item price)
 * Hints: A) Make use of Presenter model classes to put the order&item data into objects;
 *      B) Write a presenter class(that implements PresenterInterface) to format the order;
 *      C) Create a email notifier implementation to use along with PHPmailer package;
 *
 * 3. Update the order records that you sent notification for and set the item statuses to ItemStatus = 'Notification sent & 'ItemStatusId = 10;
 */
