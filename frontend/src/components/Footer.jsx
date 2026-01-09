import React from 'react';

const Footer = () => {
  return (
    <footer className=\"footer\">
      <div className=\"container\">
        <div className=\"footer-content\">
          <div className=\"footer-info\">
            <h3>DevPortfolio</h3>
            <p>Building innovative solutions with cutting-edge technology.</p>
          </div>
          <div className=\"footer-links\">
            <div className=\"social-links\">
              <a href=\"#\" target=\"_blank\" rel=\"noopener noreferrer\">GitHub</a>
              <a href=\"#\" target=\"_blank\" rel=\"noopener noreferrer\">LinkedIn</a>
              <a href=\"#\" target=\"_blank\" rel=\"noopener noreferrer\">Twitter</a>
            </div>
          </div>
        </div>
        <div className=\"footer-bottom\">
          <p>&copy; {new Date().getFullYear()} DevPortfolio. All rights reserved.</p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
