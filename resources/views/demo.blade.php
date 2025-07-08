<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giao diện nhập liệu</title>
    <style>
        /* CSS Reset and Basic Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .main-container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            height: 90vh;
            max-height: 850px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Left Panel - Navigation */
        .left-panel {
            width: 280px;
            background-color: #f7f9fa;
            border-right: 1px solid #e0e0e0;
            padding: 20px 0;
        }

        .nav-item {
            padding: 12px 20px;
            cursor: pointer;
            font-weight: 500;
            color: #333;
            border-left: 3px solid transparent;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .nav-item.active {
            background-color: #e6f7ff;
            border-left-color: #1890ff;
            color: #1890ff;
        }

        .nav-item:hover:not(.active) {
            background-color: #f0f0f0;
        }
        
        .nav-item .arrow {
            transition: transform 0.3s ease;
            font-size: 10px;
        }

        .nav-item .arrow.down {
            transform: rotate(90deg);
        }

        .dropdown-menu {
            list-style: none;
            padding-left: 23px; /* Indent sub-items */
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .dropdown-menu.show {
            max-height: 500px; /* Adjust as needed */
        }
        
        .dropdown-menu li {
            padding: 10px 20px;
            cursor: pointer;
            color: #555;
            font-weight: normal;
        }

        .dropdown-menu li:hover {
            background-color: #f0f0f0;
        }

        .dropdown-menu li.active-sub {
            background-color: #e6f7ff;
            font-weight: 500;
        }

        /* Right Panel - Content */
        .right-panel {
            flex-grow: 1;
            padding: 24px 32px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .panel-header {
            font-size: 20px;
            font-weight: 600;
            color: #1a1a1a;
            padding-bottom: 24px;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 24px;
        }

        .form-section {
            background-color: #ffffff;
            border: 1px solid #d9d9d9;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
        }
        
        .form-section-header {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        .form-group label {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d9d9d9;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1890ff;
            box-shadow: 0 0 0 2px rgba(24, 144, 255, 0.2);
        }
        
        textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Evidence Section */
        .evidence-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .evidence-header span {
            font-size: 16px;
            font-weight: 600;
        }

        .upload-btn {
            background-color: #f5f5f5;
            border: 1px solid #d9d9d9;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }

        .upload-btn:hover {
            background-color: #e0e0e0;
        }
        
        .file-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 16px;
        }

        .file-item {
            display: flex;
            align-items: center;
            background-color: #fafafa;
            border: 1px solid #e8e8e8;
            border-radius: 6px;
            padding: 12px;
        }
        
        .file-icon {
            color: #d9534f; /* PDF red color */
            font-size: 24px;
            margin-right: 12px;
        }

        .file-info {
            flex-grow: 1;
        }

        .file-info .file-name {
            font-weight: 500;
            color: #333;
        }
        
        .file-info .file-meta {
            font-size: 12px;
            color: #888;
        }

        /* Buttons */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .detailed-statement-buttons button {
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }
        
        .detailed-statement-buttons .btn-cancel {
            background-color: #fff;
            border: 1px solid #d9d9d9;
        }

        .detailed-statement-buttons .btn-add {
             background-color: #1890ff;
             color: #fff;
             border: 1px solid #1890ff;
        }
        
        .footer-buttons {
            margin-top: auto; /* Pushes buttons to the bottom */
            padding-top: 24px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }
        
        .footer-buttons button {
            padding: 10px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            font-size: 16px;
        }

        .btn-back {
            background-color: #f5f5f5;
            border: 1px solid #d9d9d9;
            color: #333;
        }

        .btn-save {
            background-color: #1890ff;
            color: #fff;
            border: none;
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="left-panel">
            <nav>
                <div class="nav-item">Initial Response</div>
                <div class="nav-item active" id="scene-info-toggle">
                    <span>Scene Information</span>
                    <span class="arrow down">&#9654;</span>
                </div>
                <ul class="dropdown-menu show" id="scene-info-menu">
                    <li class="active-sub">Initial Statements</li>
                    <li>Scene Description</li>
                    <li>Images and Videos</li>
                    <li>Preliminary Physical Evidence Information</li>
                    <li>Scene Sketch</li>
                </ul>
            </nav>
        </div>

        <div class="right-panel">
            <header class="panel-header">
                ADD INITIAL STATEMENT
            </header>

            <main>
                <section class="form-section">
                    <div class="form-section-header">
                        Initial Information
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="initial-name">Initial name</label>
                            <input type="text" id="initial-name" value="Jond">
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" id="date" value="7/20/2025">
                        </div>
                        <div class="form-group">
                            <label for="contact-info">Contact Information</label>
                            <input type="text" id="contact-info" value="+1XXXXXXXXXX">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="role">
                                <option value="witness" selected>Witness</option>
                                <option value="victim">Victim</option>
                                <option value="suspect">Suspect</option>
                            </select>
                        </div>
                    </div>
                </section>
                
                <section class="form-section">
                    <div class="form-section-header">
                        Detailed statement
                        <div class="detailed-statement-buttons">
                            <button class="btn-cancel">Cancel</button>
                            <button class="btn-add">Add</button>
                        </div>
                    </div>
                    <div class="form-group">
                       <label for="content" class="sr-only">Content of the statement</label> <textarea id="content">"I am Ms. A, a witness in this case. At about 9:00 a.m. on June 15, 2025, I was walking in the park near the crime scene. When I passed by the old tree area, I heard a loud scream. I turned around and saw a man attacking a woman. The man looked tall, wearing a blue shirt and black pants. I couldn't see his face clearly because his back was turned."</textarea>
                    </div>
                </section>

                <section>
                    <div class="evidence-header">
                        <span>Evidence Link</span>
                        <button class="upload-btn">Upload file</button>
                    </div>
                    <div class="file-list">
                        <div class="file-item">
                            <span class="file-icon">&#128442;</span> <div class="file-info">
                                <div class="file-name">File Title.png</div>
                                <div class="file-meta">313 KB, 31 Aug, 2022</div>
                            </div>
                        </div>
                        <div class="file-item">
                            <span class="file-icon">&#128442;</span>
                            <div class="file-info">
                                <div class="file-name">File Title.png</div>
                                <div class="file-meta">313 KB, 31 Aug, 2022</div>
                            </div>
                        </div>
                    </div>
                </section>

            </main>
            
            <footer class="footer-buttons">
                <button class="btn-back">Back</button>
                <button class="btn-save">Save</button>
            </footer>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('scene-info-toggle');
            const dropdownMenu = document.getElementById('scene-info-menu');
            const arrow = toggleButton.querySelector('.arrow');

            toggleButton.addEventListener('click', function() {
                // Toggle the 'show' class to trigger the CSS transition
                dropdownMenu.classList.toggle('show');
                // Toggle the arrow direction
                arrow.classList.toggle('down');
            });
        });
    </script>

</body>
</html>