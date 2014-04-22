/*global describe, it */
'use strict';
(function() {
    describe('Testing Local Storage service', function() {
        var testObject = {
            a: 1,
            b: 2,
            c: 'something'
        }
        var TEST_KEY = 'testKey';

        beforeEach(function() {
            localStorage.clear();
        });

        it('Should exists', function() {
            expect(LocalStorage).to.be.a('object');
        });

        it('Should save data to native localStorage', function() {
            expect(localStorage.getItem(TEST_KEY)).to.be.null;
            LocalStorage.set(TEST_KEY, testObject);
            expect(localStorage.getItem(TEST_KEY)).to.not.be.undefined;

        });

        it('Should get the same object after retrieving object', function() {


            LocalStorage.set(TEST_KEY, testObject);
            var obj = LocalStorage.get(TEST_KEY);

            expect(obj).to.have.property('a').and.equal(1);
            expect(obj).to.have.property('c').and.equal('something');

        });

        it('Should return default values', function() {

            var obj = LocalStorage.get(TEST_KEY);

            expect(obj).to.be.null;

            obj = LocalStorage.get(TEST_KEY, {});
            expect(obj).to.be.a('object');

            obj = LocalStorage.get(TEST_KEY, 'Hello');
            expect(obj).to.be.a('string');


        });



    });
})();
