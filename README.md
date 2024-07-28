# Product Listing App

## Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. **Import Database**
   - Open MySQL and create a database named `products_list`.
   - Import the `products.sql` file to the database.
     ```bash
     mysql -u root -p products_list < products.sql
     ```

3. **Place Product Images**
   - Copy the `products` folder containing product images to the project root directory.

4. **Configure Database Connection**
   - Ensure your MySQL credentials are correct in the `config.php` file:
     ```php
     $conn = mysqli_connect("localhost", "root", "", "products_list");
     ```

5. **Run the Application**
   - Open your browser and navigate to:
     ```url
     http://localhost/<repository-directory>/index.php
     ```

## Output Video
- Check the `output_video.mp4` file for a demonstration of the application's functionality.

---

Adjust the repository URL and directory names as needed.
