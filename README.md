# Tic Tac Toe Game with Laravel Livewire and Reverb

![Tic Tac Toe](https://img.shields.io/badge/TicTacToe-Game-blue) ![Laravel](https://img.shields.io/badge/Laravel-11.x-red) ![Livewire](https://img.shields.io/badge/Livewire-2.x-green) ![Reverb](https://img.shields.io/badge/Reverb-Websockets-purple)

A real-time Tic Tac Toe game built using **Laravel**, **Livewire**, and **Laravel Reverb**. This project demonstrates the use of server-side rendering with Livewire combined with real-time updates powered by Reverb for a collaborative and dynamic user experience.

---

## Features

- **Real-time Multiplayer:** Players can join and play in real-time using WebSocket technology powered by Laravel Reverb.
- **Server-Side Rendering:** Built with Laravel Livewire, ensuring a seamless and reactive UI without writing excessive JavaScript.
- **Broadcasting Events:** Real-time broadcasting of game updates, player moves, and lobby notifications.
- **Dynamic UI:** Minimalist and responsive UI styled with TailwindCSS.
- **User Authentication:** Secure login and registration using Laravel's built-in authentication system.

---

## Technologies Used

### Backend:
- **[Laravel](https://laravel.com/)** ![Laravel](https://img.shields.io/badge/Laravel-11.x-red)
  - PHP framework for building robust and scalable web applications.
- **[Laravel Reverb](https://laravel.com/docs/11.x/broadcasting)** ![Reverb](https://img.shields.io/badge/Reverb-Websockets-purple)
  - WebSocket broadcasting solution for real-time events.
- **MySQL** ![MySQL](https://img.shields.io/badge/MySQL-Database-orange)
  - Database used to store game data and player information.

### Frontend:
- **[Livewire](https://laravel-livewire.com/)** ![Livewire](https://img.shields.io/badge/Livewire-2.x-green)
  - Server-driven UI framework for dynamic components.
- **[TailwindCSS](https://tailwindcss.com/)** ![Tailwind](https://img.shields.io/badge/TailwindCSS-Utility--First-blue)
  - Utility-first CSS framework for responsive and modern styling.

---

## Installation

### Prerequisites
Ensure you have the following installed on your system:
- **PHP 8.2 or higher**
- **Composer**
- **Node.js and npm**
- **MySQL**

### Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-repo/tic-tac-toe.git
   cd tic-tac-toe
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Set Up Environment Variables**
   Copy `.env.example` to `.env` and configure your database and broadcasting settings:
   ```bash
   cp .env.example .env
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Start Reverb WebSocket Server**
   ```bash
   php artisan reverb:serve
   ```

6. **Run Development Server**
   ```bash
   php artisan serve
   npm run dev
   ```

7. **Access the Application**
   Visit `http://localhost:8000` in your browser.

---

## Project Structure

### Livewire Components
- `GamesDashboard`: Displays the list of available games and handles game creation and joining.
- `GameShow`: Manages the game board and real-time updates for player moves.

### Events
- `GameCreated`: Broadcast when a new game is created.
- `GameJoined`: Broadcast when a player joins a game.
- `GameUpdated`: Broadcast when a player makes a move.

### Models
- `Game`: Represents the game, including players, state, and winner.
- `User`: Represents authenticated players with built-in Laravel authentication.

---

## How It Works

### Real-Time Updates
- Events (`GameCreated`, `GameJoined`, `GameUpdated`) are broadcast using Laravel Reverb over private channels.
- The frontend listens for these events via WebSockets and updates the UI dynamically using Livewire.

### Game Logic
- The backend validates player moves and determines the winner based on the game state.
- The Livewire `GameShow` component reflects the current state of the game board in real-time.
- Authentication ensures that only registered users can create or join games.

---

## Screenshots

### Dashboard
![Dashboard Screenshot](https://via.placeholder.com/800x400?text=Dashboard+Screenshot)

### Game Board
![Game Board Screenshot](https://via.placeholder.com/800x400?text=Game+Board+Screenshot)

---

## Future Enhancements

- Add support for spectator mode.
- Implement enhanced game statistics and leaderboards.
- Add animations and transitions for a smoother user experience.

---

## License

This project is licensed under the [MIT License](LICENSE).

---

## Acknowledgments

- [Laravel Documentation](https://laravel.com/docs/)
- [Livewire Documentation](https://laravel-livewire.com/docs/)
- [TailwindCSS Documentation](https://tailwindcss.com/docs/)
