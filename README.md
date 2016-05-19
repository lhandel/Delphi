# Delphi
This project will create a queue system, using mobiles. 


##Delphi Queue


###User Manual


###1.0


###18-05-2016

###Table of Contents

1. Introduction	
  1. Purpose	
  2. Scope	
  3. Definitions, Acronyms, and Abbreviations	
  4. Overview	
  
2. General Description
  
  1. Software Overview	
  2. Hardware overview	
  3. In-store interface	
  4. Admin Interfaces	
  5. User Interface	
  6. Hardware	

3. User guide	
  1. In-store	
  2. Admin	
    - Company Login	
    - Dashboard	
    - Settings	
    - Statistics	
  3. Services	
    - Adding a new service	
    - Deleting a service	
    - Editing a service	
  4. Queue Management	
  5. User interface	
  6. Design constraints	
  
4. Analysis Models	
  1. System flowchart	


###Introduction

The Delphi Queue user manual should provide both the end-users and system admins with the information required to use and maintain the Delphi Queue system. The document includes a description of the system architecture the software is built upon. It also describes the functionality and the interfaces of the various components. The steps needed to connect the hardware and to start using the software are described.

#####1.1 Purpose

The Delphi Queue documentation is intended to give both the end-users and the system admins the information required to both use and maintain the Delphi Queue system while equating for common problems and questions that might arise. 

#####1.2 Scope

The Delphi Queue system is a digital queue system that offers the users real time tracking of their queue position and reminders trough the use of sms and web-links with real time updates. The system offers the store admins options to create, maintain and remove queues while also providing them with an oversight of who is handling the queue, the number of people in the queue and the estimated waiting time. The Delphi Queue system is configurable to work with any company and offers functionality to customize themes,set survey links, estimated waiting times, reminder messages, the services that are displayed to the customer and the number of queues and queue handlers. 

The goal with the Delphi Queue system is to replace the old type of queue systems commonly found in facilities that use pre-printed paper rolls and announce the current queue position trough lcd screens and or speakers. The customer would be able to get their queue number in the facility and track it from anywhere without being forced to stay in a determined area. The store handlers would get an oversight over the queues and have the flexibility to open and close queues and services as needed.

Implementing a smarter queuing system would result in fewer customers waiting around in the store for their queue position and thus give a less crowded facility. Replacing these system with a smart system would not only improve the queuing experience for customers but also simplify the job for the queue handlers. With the oversight provided from being able to track the estimated queue time and lengths, admins could open and close queues as needed and administer more handler and thus increasing throughput. Companies could use the sms service to survey customers in order to improve the customer experience and thus increase their profits. 


#####1.3 Definitions, Acronyms, and Abbreviations

Handler: Employe of a facility that provides the service to the queue participants.
Service: The type of service a customer will choose to queue for
Facilities: Any store/building/area that serve people using queues




#####1.4 Overview

The Delphi Queue manual is separated into several section that describe the interaction between the three components that make up the interface of the system and how they are connected. For the hardware configuring the thermal printer to work with the system is also covered in this manual. The manual is targeted both to the store admins and the queue handlers and workers.

The table of contents offers the reader a quick overview to use the document effectively.

###General Description

#####2.1 Software overview

The Delphi Queue system is a web-based solution for facilities that handle queues. The Software can be split up to the three major components its composed off. The admin interface, in-store interface and the user interface. The queue and service data is stored on a server database which is then accessed to retrieve and display the relevant information. 

#####2.2 Hardware overview

The in-store interface is displayed to the customer trough a mounted Ipad in the facility that acts as the user input device. To print a ticket there is a thermal printer connected to one of the computers running the queue system.

#####2.3 In-store interface

The in-store interface acts as the user terminal for the customers to choose their service and provide their phone number upon entering the queue. The in-store interface starting page provides the customer with a list of up to four different services to choose from which depend on the store. Selecting a service brings the user to a submit page where they can see the estimated waiting time for the current service and the number of people who are currently queueing. 

The user is prompted to enter their phone number but they also have a button to go back and change their service. Submitting a phone number and registering it prompts the user to a confirmation page where the queue number, phone number, estimated waiting time and service is displayed. The user has the option to finish their request and return to the start page leaving the next customer ready.

#####2.4 Admin interface

The admin dashboard is accessed by login in to the company login. If the correct information is entered the corresponding company admin dashboard is presented to the admin. From the admin dashboard the handler or admin can see what queues are open and which service they provide. They can see the estimated waiting time and the current queue length. An admin login is presented if they employe tries to do any changes without logging in.

Displayed under the current queues is the option to create a new queue which requires an admin to be logged in. To the left of every page there is a menu that can be opened by pressing the round menu button or by the “m” key. The menu has links to statistics, settings, admin management, and the home dashboard. From the menu the employe can see who is currently logged in and log out.

The admin management page displayed the current admin with their admin id, name and the option to edit details or to remove the admin. A new admin can be assigned from this page.
The statistics page leads to a page displaying various statistics gathered from the queue system and requires an admin to be logged in.
The settings page displays the current services and gives the option to delete, edit or to reset the queue and requires an admin to be logged in.

#####2.5 User-interface

The user interface is accessed by pressing the url provided in the sms sent to the customer. The user interface shows the customer their estimated waiting time and queue position. The customer has the option to leave the queue using a “leave queue” button. If the user leave they are prompted by a page thanking them for using the queue service.

#####2.6 Hardware

The in-store interface is designed to be run on a tablet of the Ipad model resolution and does not scale perfectly with other tablets. Printing the ticket is achieved by a thermal printer thats connected to the service and prints the information for the current costumer when called trough the api .

###User guide

#####3.1 In-store

The in-store interface displays the current services which are set by the admin in the settings page from the admin dashboard. By default the service page is empty and can hold up to four services. The admin page can not be reached from the in-store page.

The registration page is accessed from the in-store index page and displays the statistics for the current service which includes waiting time and queue number. The registration form requires a 10 digit number matching the format 07XXXXXXXX. Submitting the number with the registration button sends a sms to the receiver with their queue number, estimated waiting time and a link to a page where they can follow their queue number live. 

#####3.2 Admin

######_3.2.1 Company login_
Accessing the admin dashboard requires the user to enter the company id and password ,which upon success bring the user to the admin dashboard for the specific company

######_3.2.2 Dashboard page_
The Dashboard home page displays all current active services and has a menu button which can be reached by pressing the “m” button on the keyboard or by clicking the round button in the left top corner. 

######_3.2.3 Settings_
The settings paged is reached by opening the menu and requires an admin to be logged in to open. From the setting page the user is able to edit and remove services in addition to reseting the queue. The settings page is also where you can edit the color theme and set the survelink.

######_3.2.4 Statistics_
UNDER CONSTRUCTION

#####3.3 Services

######_3.3.1 Adding a new service_

A new service can is created from the main dashboard page which can be accessed by opening the menu and pressing the “Dashboard” button. To create a new service fill in the name of the service and press the “CREATE” button. Creating a new service leads automatically to the queue management page for the specific button. Creating a new services requires an admin to be logged in.

######_3.3.2 Deleting a service_

To delete a button open the menu and go to settings. On the settings page there is a list of the current services and options to edit them. To delete a service press the trashcan icon. Deleting a button requires an admin to be logged in.

######_3.3.2 Editing a service_
To edit a button open the menu and go to settings. From the settings page there are options to edit the reminder time and the service name. Pressing one of the buttons gives the user a prompt to enter the new value.

#####3.4 Queue management

The active services are displayed on the admin dashboard page and can be accessed by clicking on the right pointing arrow or the service name which leads to the queue management system. From the queue management the employers can control the queue if they are logged in as an admin.

The queue management page 	shows how many handlers are currently attending the queue, people in queue, estimated waiting time and the current queue number. From the queue management page the admin has the option to go to the settings page or to change services

The current number is customer which is being served right now. To start serving the next customer press “next”. If the customer does not show up the “skip” button will skip the current number and take the next one.



#####3.5 User interface

The user interface should only be reachable by the user from clicking the link received in the sms. The page displays the estimated waiting time and queue number and has a button called leave queue. If a user presses the leave queue button he is first alerted a message asking “Are you sure you want to leave the queue” and is only booted if he answers yes to the alert.

#####3.6 Design Constraints

The in-store page is currently limited to display a maximum of four services which can be changed but is a deliberate decision cause we don't want the customer to scroll the page to find their service.

Because the user is prompted to enter their phone number the in-store tablet has to be in portrait mode. If the tablet is put on the side the keyboard will cover information.



