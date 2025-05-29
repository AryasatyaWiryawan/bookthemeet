# Book The Meet

Project by Aryasatya Wiryawan - 5025221256

DAA (D)

A Laravel 12 prototype that lets you manage meeting rooms and meeting requests, then uses a **greedy interval-scheduling** algorithm to assign as many non-overlapping meetings to each room as possible.

---

## 🔍 Features

- **Rooms CRUD**: create, edit, delete rooms  
- **Meetings CRUD**: create, edit, delete meeting requests (title, start & end time)  
- **Scheduler**: “Optimize Meetings” button runs a greedy algorithm to assign meetings to rooms  
- **Date-scoped**: filter and optimize by a specific date  
- **CSV Export**: download the current room-meeting assignments  

---

## ⚙️ Requirements

- PHP 8.1+  
- Composer  
- Laravel 12  
- MySQL (or other supported DB)  
- (Optional) Node.js & npm for frontend asset compilation  

---

## 🚀 Installation

1. **Clone the repo**  
   ```bash
   git clone https://github.com/AryasatyaWiryawan/bookthemeet.git
   cd bookthemeet

2. **Install PHP dependencies**

   ```bash
   composer install
   php artisan key:generate
   ```

3. **Configure your database**
   Copy `.env.example` to `.env` and update:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=optimizer_db
   DB_USERNAME=your_user
   DB_PASSWORD=your_pass
   ```

4. **Run migrations & seeders**

   ```bash
   php artisan migrate:fresh --seed
   ```

5. **(Optional) Compile assets**

   ```bash
   npm install
   npm run dev
   ```

6. **Serve the app**

   ```bash
   php artisan serve
   # visit http://127.0.0.1:8000
   ```

---

## 📚 Usage

1. **Rooms**

   * Browse to `/rooms`
   * Add new rooms, edit names, or delete unused rooms.

2. **Meetings**

   * Browse to `/meetings`
   * Create meeting requests with title, start & end datetime
   * Edit or delete existing requests.

3. **Schedule**

   * Visit `/schedule`
   * Use the date-picker to select a date (default: today)
   * Click **Filter** to load that day’s meetings
   * Click **Optimize for YYYY-MM-DD** to run the scheduler
   * Click **Export CSV** to download the assignments

---

## 🤖 Algorithm

We implement the **interval-scheduling** greedy algorithm (Lecture #9, Ch. 16):

1. **Sort** all meeting requests by their **start** time (or finish time).
2. Keep an array of **room availability**: each room’s last-assigned end time.
3. **Iterate** through meetings in order:

   * Find the first room whose last-end ≤ meeting’s start
   * **Assign** the meeting to that room and update its last-end to the meeting’s end
4. Continue until all meetings are processed.

## 📂 Repository

[https://github.com/AryasatyaWiryawan/bookthemeet](https://github.com/AryasatyaWiryawan/bookthemeet)
```

