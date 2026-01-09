import React from 'react';

const About = () => {
  return (
    <section id=\"about\" className=\"about section\">
      <div className=\"container\">
        <h2 className=\"section-title\">About Me</h2>
        <div className=\"about-content\">
          <div className=\"about-text\">
            <p>
              I'm a passionate full-stack developer with over 5 years of experience creating 
              web applications and digital solutions. My journey in tech started when I built 
              my first website at age 16, and I've been hooked ever since.
            </p>
            <p>
              I specialize in building modern web applications using React, Node.js, and cloud technologies. 
              I believe in writing clean, maintainable code and creating intuitive user experiences.
            </p>
            <p>
              When I'm not coding, you can find me contributing to open-source projects, 
              writing technical articles, or exploring new technologies.
            </p>
          </div>
          <div className=\"about-stats\">
            <div className=\"stat\">
              <h3>50+</h3>
              <p>Projects Completed</p>
            </div>
            <div className=\"stat\">
              <h3>5+</h3>
              <p>Years Experience</p>
            </div>
            <div className=\"stat\">
              <h3>20+</h3>
              <p>Happy Clients</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default About;
