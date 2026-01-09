# AI-Powered Developer Portfolio

A modern, full-stack developer portfolio featuring AI-powered interactions using Google Gemini. The portfolio showcases projects, skills, and allows visitors to ask questions about the developer and their work.

## Features

- **Modern UI**: Built with React and modern web standards
- **AI Integration**: Ask questions about the portfolio using Google Gemini AI
- **Responsive Design**: Works on all device sizes
- **Project Showcase**: Highlight your projects with detailed descriptions
- **Skill Visualization**: Interactive skill bars and categories
- **Contact Form**: Easy way for visitors to reach out
- **Dark Mode**: Toggle between light and dark themes

## Tech Stack

- **Frontend**: React, Vite, JavaScript/ES6+
- **Backend**: PHP with REST API
- **AI Integration**: Google Gemini API
- **Deployment**: Docker container for Google Cloud Run
- **Architecture**: Single container serving both frontend and backend

## Architecture

The application runs in a single Docker container with:
- Apache web server on port 8080
- React frontend built as static files
- PHP backend exposing API routes under `/api/*`
- Frontend communicates with backend via fetch/axios
- Gemini API key stored securely using environment variables

## Prerequisites

- Node.js (v16 or higher)
- PHP (v8.0 or higher)
- Docker
- Google Gemini API Key

## Setup Instructions

### 1. Clone the Repository

```bash
git clone <repository-url>
cd ai-powered-portfolio
```

### 2. Frontend Setup

```bash
# Navigate to frontend directory
cd frontend

# Install dependencies
npm install

# Start the development server
npm run dev
```

The frontend will be available at `http://localhost:3000`

### 3. Backend Setup

First, create a `.env` file in the root directory:

```env
GEMINI_API_KEY=your_google_gemini_api_key_here
```

The backend serves API requests at `http://localhost:8080/api/*`

### 4. Running the Application

#### Development Mode

For development, you can run the frontend and backend separately:

```bash
# Terminal 1: Start the PHP backend
cd backend
php -S localhost:8080 index.php

# Terminal 2: Start the React frontend
cd frontend
npm run dev
```

#### Production Build

To build the entire application:

```bash
# Build the frontend
npm run build

# The built files will be copied to the public directory
```

Then run the PHP server from the backend directory:

```bash
cd backend
php -S localhost:8080 index.php
```

The application will be available at `http://localhost:8080`

## AI Integration

The portfolio features an "Ask My Portfolio" section that allows users to ask questions about the developer and their projects. The AI integration works as follows:

1. User submits a question in the frontend
2. React sends a POST request to `/api/ask` with the prompt
3. PHP backend calls Google Gemini API with the prompt
4. Gemini API returns a response
5. Response is formatted and sent back to the frontend
6. Response is displayed to the user

### Configuring Gemini API

1. Get your Gemini API key from [Google AI Studio](https://aistudio.google.com/)
2. Add it to your `.env` file as shown above
3. Ensure the backend can access the environment variable

## Docker Deployment

The application is designed for deployment to Google Cloud Run using Docker.

### Building the Docker Image

```bash
docker build -t ai-portfolio .
```

### Running Locally with Docker

```bash
docker run -p 8080:8080 -e GEMINI_API_KEY=your_key_here ai-portfolio
```

The application will be available at `http://localhost:8080`

### Deploying to Google Cloud Run

1. Build and push the image to Google Container Registry:

```bash
docker build -t gcr.io/YOUR_PROJECT_ID/ai-portfolio .
docker push gcr.io/YOUR_PROJECT_ID/ai-portfolio
```

2. Deploy to Cloud Run:

```bash
gcloud run deploy ai-portfolio \
  --image gcr.io/YOUR_PROJECT_ID/ai-portfolio \
  --platform managed \
  --region YOUR_REGION \
  --port 8080 \
  --set-env-vars GEMINI_API_KEY=YOUR_GEMINI_API_KEY
```

Replace `YOUR_PROJECT_ID`, `YOUR_REGION`, and `YOUR_GEMINI_API_KEY` with your actual values.

## API Endpoints

- `POST /api/ask` - Send a prompt to the Gemini AI and receive a response
  - Request Body: `{ "prompt": "your question here" }`
  - Response: `{ "success": true, "response": "AI-generated response", "prompt": "your original prompt" }`

## Project Structure

```
├── frontend/               # React frontend source
│   ├── src/
│   │   ├── components/     # React components
│   │   ├── pages/          # Page components
│   │   ├── services/       # API service layer
│   │   └── assets/         # Static assets
│   ├── package.json
│   └── vite.config.js
├── backend/                # PHP backend
│   ├── api/                # API endpoints
│   ├── config/             # Configuration files
│   └── index.php           # Main entry point
├── public/                 # Built frontend files
├── Dockerfile              # Container configuration
├── .env.example            # Environment variables example
└── README.md
```

## Security Considerations

- Store the Gemini API key securely as an environment variable
- Never expose the API key in client-side code
- Implement rate limiting in production
- Validate and sanitize all inputs

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## License

This project is licensed under the MIT License.