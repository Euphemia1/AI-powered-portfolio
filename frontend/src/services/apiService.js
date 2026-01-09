const API_BASE_URL = process.env.REACT_APP_API_URL || '/api';

const apiService = {
  async askQuestion(prompt) {
    try {
      const response = await fetch(\\/ask\, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ prompt }),
      });

      if (!response.ok) {
        throw new Error(\HTTP error! status: \\);
      }

      const data = await response.json();
      return data;
    } catch (error) {
      console.error('API call failed:', error);
      throw error;
    }
  },
};

export default apiService;
