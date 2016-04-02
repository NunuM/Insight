/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


angular.module("insight", ['ngRoute', 'rest.services', 'pusher-angular'])
        .config(function ($routeProvider, $locationProvider) {
            $routeProvider
                    .when('/project/:id', {
                        templateUrl: 'view/project.html',
                        controller: 'projectController'
                    })
                    .when('/project/:id/board/:id', {
                        templateUrl: 'view/board.html',
                        controller: 'boardController'
                    })
                    .otherwise({
                        redirectTo: '/'
                    });

        }).controller('boardController', ['$scope', 'User', 'Question', 'Answer', 'Chat', '$pusher', '$routeParams', 'Board', function ($scope, User, Question, Answer, Chat, $pusher, $routeParams, Board) {
        $scope.initAFormState = false;
        $scope.toggleFormState = function (id) {
            $scope.currentQ = id;
            $scope.initAFormState = !$scope.initAFormState;
        };

        $scope.initQFormState = false;
        $scope.toggleQFormState = function () {
            $scope.initQFormState = !$scope.initQFormState;
        };

        $scope.addQuestion = function (post) {
            post.user_id = $scope.user.id;

            Question.new({}, post).$promise.then(function (response) {
                alert("Successuful created");
                $scope.questions.unshift(response);

            });

            post = {};

            $scope.toggleQFormState();
        };

        $scope.addAnswers = function (post) {
            post.user_id = $scope.user.id;
            post.question_id = $scope.currentQ.id;

            Answer.new({}, post).$promise.then(function (response) {

                $scope.answers.unshift(response);

            });
            post = {};
            $scope.currentQ.answers++;
            $scope.toggleFormState();
        };

        Board.get({id: $routeParams.id}).$promise.then(function (board) {
            $scope.board = board;

            Question.get({id: $scope.board.id}).$promise.then(function (questions) {
                $scope.questions = questions.data;
            });


        });

        $scope.getAnswers = function (idQ) {
            $scope.answers = {};
            Answer.get({id: idQ}).$promise.then(function (answer) {
                $scope.answers = answer;
            });

        };


        var client = new Pusher('bf45332979c23295f762');
        var pusher = $pusher(client);
        pusher.subscribe('chat');
        pusher.bind('new-message',
                function (data) {
                    console.log(data);
                    $scope.chatMessages.data.push(data);
                }
        );

        Chat.get({}).$promise.then(function (data) {
            $scope.chatMessages = data;
        });

        $scope.addChatMessage = function (post) {
            post.user_id = $scope.user.id;

            Chat.new({}, post).$promise.then(function (response) {

                // $scope.chatMessages.unshift(response);

            });
            post = {};

        };



    }]).controller('projectController', ['$scope', '$routeParams', 'Project', function ($scope, $routeParams, Project) {

        Project.get({}).$promise.then(function (data) {
            $scope.projects = data;
        });

        Project.get({id: $routeParams.id}).$promise.then(function (data) {
            $scope.project = data;
        });

        $scope.formatDate = function (date) {
            var date = date.split("-").join("/");
            var dateOut = new Date(date);
            return dateOut;
        };

    }]).directive('questionInfo', [function () {
        return {
            restrict: 'E',
            templateUrl: 'view/question.html',
            scope: {data: '=', editable: '='},
            controller: ['$scope', function ($scope) {

                    $scope.formatDate = function (date) {
                        var date = date.split("-").join("/");
                        var dateOut = new Date(date);
                        return dateOut;
                    };

                }],
            link: function (scope, element, attrs) {
                element.bind('click', function () {
                    toggleActiveElement(this);
                    element.find('a').addClass('active');
                });
            }
        };

    }]).directive('answerInfo', [function () {
        return {
            restrict: 'E',
            templateUrl: 'view/answer.html',
            scope: {data: '=', editable: '='},
            controller: ['$scope', function ($scope) {

                    $scope.formatDate = function (date) {
                        var date = date.split("-").join("/");
                        var dateOut = new Date(date);
                        return dateOut;
                    };

                }],
            link: function (scope, element, attrs) {

            }
        };

    }]).filter('dateToISO', function () {
    return function (input) {
        input = new Date(input).toISOString();
        return input;
    };
});



angular.module('rest.services', ['ngResource'])

        .factory('User', ['$resource', function ($resource) {
                return $resource('api/user/:id', {id: '@id'}, {'get': {method: 'GET'}});
            }])
        .factory('Question', ['$resource', function ($resource) {
                return $resource('/api/question/:id', {id: '@id'}, {'update': {method: 'PUT'}, 'new': {method: 'POST'}});
            }])
        .factory('Answer', ['$resource', function ($resource) {
                return $resource('/api/answer/:id', {id: '@id'}, {'update': {method: 'PUT'}, 'get': {isArray: true}, 'new': {method: 'POST'}});
            }])
        .factory('Chat', ['$resource', function ($resource) {
                return $resource('/api/chat/:id', {id: '@id'}, {'get': {isArray: false}, 'new': {method: 'POST'}});
            }])
        .factory('Project', ['$resource', function ($resource) {
                return $resource('/api/project/:id', {id: '@id'}, {'get': {isArray: false}, 'new': {method: 'POST'}});
            }])
        .factory('Board', ['$resource', function ($resource) {
                return $resource('/api/board/:id', {id: '@id'}, {'get': {isArray: false}, 'new': {method: 'POST'}});
            }]);



var activeElement;
var toggleActiveElement = function (el) {
    if (activeElement !== null)
        $(activeElement).find('a').removeClass('active');
    activeElement = el;
};

