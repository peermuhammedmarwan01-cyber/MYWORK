# Quick Start - Admin Panel Setup (5 Minutes)

## Step 1: Create Database Tables (2 minutes)
1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Click on `portfolio_db` database
3. Go to SQL tab
4. Paste this code:

```sql
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

INSERT INTO categories (name, slug) VALUES
('Vector', 'vector'),
('Raster', 'raster'),
('UI/UX', 'uiux'),
('Printing', 'printing');
```

5. Click **Go** ✓

## Step 2: Access Admin Panel (30 seconds)
Go to: `http://localhost/mrdesign/admin/`

You should see the dashboard with:
- 4 categories already created
- Option to upload images
- View Website link

## Step 3: Upload Portfolio Images (2 minutes)
1. Click **Upload New Image** button
2. Select a category (Vector, Raster, UI/UX, or Printing)
3. Enter image title
4. Drag & drop or click to select image file
5. Click **Upload Image**
6. Done! Image appears on portfolio section

## Step 4: View Changes on Website
1. Click **View Website** in admin panel
2. Scroll to Portfolio section
3. See your uploaded images
4. Click filter buttons (VECTOR, RASTER, etc.) to filter

---

## What's Included

✅ **Admin Dashboard** - Overview of content
✅ **Category Manager** - Create, edit, delete categories
✅ **Image Manager** - Upload, view, delete portfolio images
✅ **Dynamic Portfolio** - Frontend shows images from database
✅ **Filter System** - Working filter by category
✅ **Upload Folder** - assets/uploads/portfolio/

## Files Created

```
✅ config/db.php - Database connection
✅ admin/index.php - Dashboard
✅ admin/categories.php - Category list
✅ admin/add_category.php - Add category form
✅ admin/edit_category.php - Edit category form
✅ admin/delete_category.php - Delete category script
✅ admin/images.php - Images gallery
✅ admin/upload_image.php - Upload form
✅ admin/delete_image.php - Delete image script
✅ admin/admin-style.css - Admin styling
✅ functions.php - Portfolio functions
✅ database_setup.sql - Database setup script
✅ Updated index.php - Now uses database
```

## Key Features

- 🎨 Modern, clean admin interface
- 📱 Responsive design
- 🖼️ Drag & drop image upload
- ✅ File validation (size & type)
- 🔄 Real-time frontend updates
- 🗑️ Easy content management
- 🔐 Basic security (prepared statements)

## Troubleshooting

| Issue | Solution |
|-------|----------|
| Admin page won't load | Check if database tables are created |
| Can't upload images | Check upload folder permissions |
| Images not showing | Verify images exist in assets/uploads/portfolio/ |
| Categories dropdown empty | Create categories first before uploading |

---

**Ready to go!** Your simple admin panel is set up. Start uploading portfolio content now! 🚀
