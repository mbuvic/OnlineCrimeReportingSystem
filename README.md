# Complaint Reporting & Response Management System (CRMS)

A web-based system that enables users to report, track, and monitor complaints while providing administrators with an efficient platform for complaint handling and response management. The system features integrated barcode functionality for unique complaint identification and tracking.

The CRMS provides a comprehensive solution for both users and organizations:
- For Users: Register complaints, track status updates, and monitor resolution progress
- For Organizations: Centralized platform for managing complaints with role-based access control, real-time status updates, and comprehensive reporting capabilities
- Features include barcode generation for unique complaint identification, responder management, station assignment, and detailed audit trails

## Repository Structure
```
.
├── admin/                     # Admin dashboard and core functionality
│   ├── admin_class.php       # Admin authentication and core business logic
│   ├── ajax.php              # AJAX request handlers
│   ├── assets/               # Frontend assets (CSS, JS, libraries)
│   ├── db_connect.php        # Database connection configuration
│   ├── complaints.php        # Complaint management interface
│   ├── responders.php        # Responder management interface
│   └── stations.php          # Station management interface
├── database/                 # Database schema and migrations
│   └── crms_db.sql          # SQL database schema
├── css/                      # Public frontend styles
├── js/                      # Public frontend scripts
└── index.php               # Public entry point
```

## Usage Instructions

### Prerequisites
- PHP 7.2 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Modern web browser with JavaScript enabled

### Installation
1. Clone the repository to your web server directory:
```bash
git clone <repository-url>
cd crms
```

2. Import the database schema:
```bash
mysql -u username -p database_name < database/crms_db.sql
```

3. Configure database connection in `admin/db_connect.php`:
```php
$conn = new mysqli('localhost', 'username', 'password', 'database_name');
```

4. Set appropriate permissions:
```bash
chmod 755 -R admin/assets/
chmod 644 admin/db_connect.php
```

### Quick Start
1. Access the admin panel at `http://your-domain/admin/`
2. Login with default credentials:
   - Username: admin
   - Password: admin123
3. Configure system settings in Site Settings
4. Add stations and responders
5. Start managing complaints

### More Detailed Examples

#### Managing Complaints
1. Navigate to Complaints section
2. Click "New Complaint" to create a complaint
3. Fill required details:
   - Complainant information
   - Complaint description
   - Assigned station/responder
4. Generate and print barcode for tracking
5. Track status updates and resolutions

#### Generating Reports
1. Access Reports section
2. Select report type:
   - Complaint summary
   - Response time analysis
   - Station performance
3. Set date range and filters
4. Export to PDF/CSV format

### Troubleshooting

Common Issues:
1. Database Connection Errors
   - Verify database credentials in db_connect.php
   - Check MySQL service status
   - Ensure database exists and is accessible

2. File Upload Issues
   - Check directory permissions (755 for folders, 644 for files)
   - Verify upload_max_filesize in PHP configuration
   - Clear temporary upload directory

3. Barcode Generation Fails
   - Ensure PHP GD library is installed
   - Check write permissions for barcode directory
   - Verify proper Picqer library installation

## Data Flow
The CRMS follows a structured workflow for complaint management:

```ascii
[Complainant] -> [Submit Complaint] -> [Admin Review] -> [Assign Responder]
                                                     -> [Generate Barcode]
                                                     -> [Track Status]
[Responder] -> [Update Status] -> [Resolution] -> [Close Complaint]
```

Key component interactions:
- Complaint submission triggers notification to admin
- Admin assigns appropriate responder based on complaint type
- Barcode generation creates unique tracking identifier
- Status updates flow between responder and complainant
- Resolution triggers complaint closure and reporting
- System maintains audit trail of all interactions
- Reports aggregate data for analysis and insights