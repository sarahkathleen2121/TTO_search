@extends('frontend.layouts.master')

@section('title', 'Home - Welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/user-dashboard.css') }}">
    <div class="dashboard-container">
        <!-- Header with Greeting and Create Button -->
        <div class="dashboard-header">
            <div class="user-greeting">
                <h1>Hi, John!</h1>
                <p>Welcome back to your design boards</p>
            </div>
            <button class="create-board-btn" id="createBoardBtn">
                <i class="fas fa-plus"></i> Create New Board
            </button>
        </div>

        <!-- Boards Section -->
        <div class="boards-section">
            <h2 class="section-title">Your Boards</h2>

            <!-- Board Grid - Show this if user has boards -->
            <div class="boards-grid" id="boardsGrid">
                <!-- Board cards will be dynamically inserted here -->
            </div>

            <!-- No Boards State - Show this if user has no boards -->
            <div class="no-boards" id="noBoardsState">
                <div class="no-boards-icon">
                    <i class="far fa-clipboard"></i>
                </div>
                <h3>No design boards yet</h3>
                <p>Get started by creating your first design board. Save your favorite designs, inspirations, and ideas in
                    one place.</p>
                <button class="create-board-btn" id="createBoardBtn2">
                    <i class="fas fa-plus"></i> Create Your First Board
                </button>
            </div>
        </div>
    </div>

    <script>
        // Sample board data - in a real app, this would come from your backend
        const sampleBoards = [{
                id: 1,
                title: 'Living Room Ideas',
                date: 'Created on Oct 15, 2023',
                image: 'https://images.unsplash.com/photo-1616486338815-3e985ddd428d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
            },
            {
                id: 2,
                title: 'Office Space',
                date: 'Created on Nov 2, 2023',
                image: 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
            },
            {
                id: 3,
                title: 'Bedroom Design',
                date: 'Created on Nov 10, 2023',
                image: 'https://images.unsplash.com/photo-1566665797739-1674de7a421c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
            }
        ];

        // DOM Elements
        const boardsGrid = document.getElementById('boardsGrid');
        const noBoardsState = document.getElementById('noBoardsState');
        const createBoardBtns = document.querySelectorAll('.create-board-btn');

        // Check if user has boards and render accordingly
        function renderBoards() {
            // In a real app, you would check the user's boards from your backend
            const hasBoards = sampleBoards.length > 0;

            if (hasBoards) {
                // Show boards grid and hide no boards state
                boardsGrid.style.display = 'grid';
                noBoardsState.style.display = 'none';

                // Clear existing boards
                boardsGrid.innerHTML = '';

                // Add boards to the grid
                sampleBoards.forEach(board => {
                    const boardElement = document.createElement('div');
                    boardElement.className = 'board-card';
                    boardElement.innerHTML = `
                        <div class="board-image" style="background-image: url('${board.image}')">
                            <div class="board-overlay">
                                <button class="view-board-btn">
                                    <i class="fas fa-eye"></i> View Board
                                </button>
                            </div>
                        </div>
                        <div class="board-info">
                            <h3 class="board-title">${board.title}</h3>
                            <p class="board-date">${board.date}</p>
                        </div>
                    `;
                    boardsGrid.appendChild(boardElement);
                });
            } else {
                // Show no boards state
                boardsGrid.style.display = 'none';
                noBoardsState.style.display = 'block';
            }
        }

        // Handle create board button click
        function handleCreateBoard() {
            // In a real app, this would open a modal or navigate to board creation
            alert('Create new board functionality would open here');
            // You can implement the board creation UI as shown in your 6th image
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', () => {
            renderBoards();

            createBoardBtns.forEach(btn => {
                btn.addEventListener('click', handleCreateBoard);
            });
        });
    </script>
@endsection
