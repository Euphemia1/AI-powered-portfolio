import React, { useState } from 'react';

const Contact = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    message: ''
  });
  const [status, setStatus] = useState('');

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    setStatus('Sending...');
    
    // In a real app, this would send to your backend
    setTimeout(() => {
      setStatus('Message sent successfully!');
      setFormData({ name: '', email: '', message: '' });
    }, 1000);
  };

  return (
    <section id=\"contact\" className=\"contact section\">
      <div className=\"container\">
        <h2 className=\"section-title\">Get In Touch</h2>
        <div className=\"contact-content\">
          <div className=\"contact-info\">
            <h3>Contact Information</h3>
            <p>Feel free to reach out to me for any inquiries, collaboration opportunities, or just to say hello!</p>
            <div className=\"contact-details\">
              <div className=\"contact-item\">
                <strong>Email:</strong> <a href=\"mailto:contact@example.com\">contact@example.com</a>
              </div>
              <div className=\"contact-item\">
                <strong>Location:</strong> San Francisco, CA
              </div>
            </div>
          </div>
          <form className=\"contact-form\" onSubmit={handleSubmit}>
            <div className=\"form-group\">
              <label htmlFor=\"name\">Name</label>
              <input
                type=\"text\"
                id=\"name\"
                name=\"name\"
                value={formData.name}
                onChange={handleChange}
                required
              />
            </div>
            <div className=\"form-group\">
              <label htmlFor=\"email\">Email</label>
              <input
                type=\"email\"
                id=\"email\"
                name=\"email\"
                value={formData.email}
                onChange={handleChange}
                required
              />
            </div>
            <div className=\"form-group\">
              <label htmlFor=\"message\">Message</label>
              <textarea
                id=\"message\"
                name=\"message\"
                value={formData.message}
                onChange={handleChange}
                rows=\"5\"
                required
              ></textarea>
            </div>
            <button type=\"submit\" className=\"btn\" disabled={status === 'Sending...'}>
              {status || 'Send Message'}
            </button>
          </form>
        </div>
      </div>
    </section>
  );
};

export default Contact;
