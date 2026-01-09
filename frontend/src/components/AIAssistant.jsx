import React, { useState } from 'react';
import apiService from '../services/apiService';

const AIAssistant = () => {
  const [question, setQuestion] = useState('');
  const [response, setResponse] = useState('');
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  const handleAsk = async () => {
    if (!question.trim()) {
      setError('Please enter a question');
      return;
    }

    setLoading(true);
    setError('');
    setResponse('');

    try {
      const result = await apiService.askQuestion(question);
      setResponse(result.response);
    } catch (err) {
      setError(err.message || 'An error occurred while asking the question');
    } finally {
      setLoading(false);
    }
  };

  const predefinedQuestions = [
    'Tell me about your Bravelender project',
    'What technologies do you specialize in?',
    'How did you become a developer?',
    'What makes your approach unique?'
  ];

  const handlePredefinedQuestion = (q) => {
    setQuestion(q);
  };

  return (
    <section id=\"ai-assistant\" className=\"ai-assistant section\">
      <div className=\"container\">
        <h2 className=\"section-title\">Ask My Portfolio</h2>
        <p className=\"section-subtitle\">Ask me anything about my work, projects, or skills. Powered by AI.</p>
        
        <div className=\"ai-container\">
          <div className=\"question-section\">
            <div className=\"predefined-questions\">
              <h3>Try asking:</h3>
              <div className=\"question-tags\">
                {predefinedQuestions.map((q, index) => (
                  <button 
                    key={index} 
                    className=\"question-tag\"
                    onClick={() => handlePredefinedQuestion(q)}
                  >
                    {q}
                  </button>
                ))}
              </div>
            </div>

            <div className=\"custom-question\">
              <textarea
                value={question}
                onChange={(e) => setQuestion(e.target.value)}
                placeholder=\"Ask me anything about my projects, skills, or experience...\"
                rows=\"3\"
              />
              <button 
                className=\"btn\" 
                onClick={handleAsk} 
                disabled={loading}
              >
                {loading ? 'Thinking...' : 'Ask AI'}
              </button>
            </div>
          </div>

          {(response || error) && (
            <div className=\"response-section\">
              {error && <div className=\"error-message\">{error}</div>}
              {response && (
                <div className=\"response-content\">
                  <h3>AI Response:</h3>
                  <div className=\"response-text\">{response}</div>
                </div>
              )}
            </div>
          )}
        </div>
      </div>
    </section>
  );
};

export default AIAssistant;
