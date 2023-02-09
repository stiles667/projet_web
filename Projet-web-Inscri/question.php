<?php


class Question {
    private $question;
    private $choices;
    private $answer;
  
    public function __construct($question, $choices, $answer) {
      $this->question = $question;
      $this->choices = $choices;
      $this->answer = $answer;
    }
  
    public function getQuestion() {
      return $this->question;
    }
  
    public function getChoices() {
      return $this->choices;
    }
  
    public function getAnswer() {
      return $this->answer;
    }
  }
  class Quiz {
    private $questions;
  
    public function __construct() {
      $this->questions = array();
    }
  
    public function addQuestion(Question $question) {
      array_push($this->questions, $question);
    }
  
    public function getQuestions() {
      return $this->questions;
    }
  }
  $quiz = new Quiz();
  $quiz->addQuestion(new Question("Quel est le capital de la France?", ["Lyon", "Marseille", "Paris", "Toulouse"], "Paris"));
  $quiz->addQuestion(new Question("Quel est le plus grand pays du monde en termes de superficie?", ["Russie", "Canada", "Chine", "États-Unis"], "Russie"));
  
  header('Content-Type: application/json');
  echo json_encode($quiz->getQuestions());
      
